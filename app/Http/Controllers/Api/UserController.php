<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Filters\UserFilter;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;

class UserController extends ApiController
{
  protected $policyClass = UserPolicy::class;
  public function __construct(protected UserService $userService) {}

  public function addStaff(RegistrationRequest $request)
  {
    try {
      $this->isAble('store', User::class);
      $payload = (object) $request->validated();

      return $this->ok(
        'Staff Added Successfully',
        new UserResource($this->userService->addStaff($payload))
      );
    } catch (Throwable $th) {
      return $this->error($th->getMessage());
    }
  }

  public function getStaffs(UserFilter $userFilter)
  {
    try {
      $this->isAble('view', User::class);

      return $this->ok('Staff Fetched Successfully', UserResource::collection(User::filter($userFilter)->paginate()));
    } catch (Throwable $th) {
      return $this->error($th->getMessage());
    }
  }

  public function generatePassword()
  {
    try {
      return $this->ok(
        'Password Generated Successfully',
        ['password' => $this->passwordGenerator()]
      );
    } catch (Throwable $th) {
      return $this->error($th->getMessage());
    }
  }
  public function login(LoginRequest $request)
  {
    try {
      $payload = (object) $request->validated();

      return $this->ok(
        'User Logged In Successfully',
        new UserResource($this->userService->loginByEmailOrStaffCode($payload))
      );
    } catch (Throwable $th) {
      return $this->error($th->getMessage());
    }
  }

  public function logout(Request $request)
  {
    $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

    return $this->ok('');
  }

  public function resetUserPassword(ResetPasswordRequest $request)
  {
    try {
      $this->isAble('resetPassword', User::class);
      $payload = (object) $request->validated();

      return $this->ok(
        'Password Reset Successfully',
        new UserResource($this->userService->resetUserPassword($payload))
      );
    } catch (Throwable $th) {
      return $this->error($th->getMessage());
    }
  }
}
