<?php

namespace App\Services;

use App\Traits\General;
use Exception;
use App\Models\User;
use App\Permissions\Abilities;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\WelcomeEmailNotification;
use App\Notifications\PasswordResetNotification;

class UserService extends BaseService
{
  use General;
  public function __construct(protected UserRepository $userRepository, protected AuditService $auditService)
  {
    parent::__construct($userRepository);
  }

  public function loginByEmailOrStaffCode($payload): Model
  {
    if ($this->cantAttemptAuth($payload)) {
      throw new Exception('Records provided does not match with our record.');
    }

    $user = $this->getUserByIdentifier($payload->identifier);

    $user->token = $user->createToken(
      "API token for  $user->email",
      Abilities::getAbilities($user),
      now()->addMinutes(60)
    )->plainTextToken;
    $this->auditService->log([
      'staff_id' => $user->id,
      'action' => 'Login',
      'resources' => 'User',
      'description' => "$user->first_name $user->last_name, logged in",
      'created_by' => "$user->first_name $user->last_name ($user->email)",
      'status' => 'completed'
    ]);
    return $user;
  }

  private function cantAttemptAuth($payload): bool
  {
    return ! Auth::attempt(['email' => $payload->identifier, 'password' => $payload->password]) &&
      ! Auth::attempt(['staff_code' => $payload->identifier, 'password' => $payload->password]);
  }

  private function getUserByIdentifier(?string $identifier): ?User
  {
    return $this->userRepository->findByWhere('email', $identifier)
      ?: $this->userRepository->findByWhere('staff_code', $identifier);
  }

  public function addStaff($payload)
  {
    $adminUser = Auth::user();
    $user = $this->userRepository->create([
      'email' => $payload->email,
      'password' => Hash::make($payload->password),
      'staff_code' => $payload->staff_code,
      'role_id' => $payload->role_id,
      'name' => $payload->name,
      'created_by' => "$adminUser->name  ( $adminUser->email)",
      'status' => 'active',
    ]);
    $this->auditService->log([
      'staff_id' => $adminUser->staff_code,
      'action' => 'Create',
      'resources' => 'User',
      'description' => "$adminUser->name, created a staff with the email $user->email and code $user->staff_code",
      'created_by' => "$adminUser->name  ( $adminUser->email)",
      'status' => 'completed'
    ]);
    $emailPayload = (object) [
      'password' => $payload->password,
      'user' => $user
    ];
    $user->notify(new WelcomeEmailNotification($emailPayload));
    return $user;
  }

  public function resetUserPassword($payload)
  {
    $password = $this->passwordGenerator();
    $user = $this->userRepository->find($payload->user_id);
    $user->password = Hash::make($password);
    $user->save();
    $this->auditService->log([
      'staff_id' => Auth::user()->staff_code,
      'action' => 'Reset Password',
      'resources' => 'User',
      'description' => "Password reset for $user->name",
      'created_by' => Auth::user()->name,
      'status' => 'completed'
    ]);
    $emailPayload = (object) [
      'password' => $password,
      'user' => $user
    ];
    $user->notify(new PasswordResetNotification($emailPayload));
    return $user;
  }
}
