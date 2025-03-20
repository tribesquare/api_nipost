<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Permissions\Abilities;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
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
}
