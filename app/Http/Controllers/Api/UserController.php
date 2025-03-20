<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Api\ApiController;

class UserController extends ApiController
{
  protected $policyClass = UserPolicy::class;
  public function __construct(protected UserService $userService) {}

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
}
