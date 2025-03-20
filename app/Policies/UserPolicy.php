<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions\Abilities;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
  /**
   * Create a new policy instance.
   */
  public function __construct() {}

  public function delete(User $user)
  {
    return $user->tokenCan(Abilities::DeleteUser) ? true : false;
  }

  public function replace(User $user)
  {
    return $user->tokenCan(Abilities::ReplaceUser) ? true : false;
  }

  public function store(User $user)
  {
    return $user->tokenCan(Abilities::CreateUser);
  }

  public function view(User $user)
  {
    if ($user->tokenCan(Abilities::ViewAnyUser)) {
      return true;
    } else if ($user->tokenCan(Abilities::ViewUser)) {
      return $user->id === Auth::user()->id;
    }
    return false;
  }

  public function update(User $user)
  {
    return $user->tokenCan(Abilities::UpdateUser) ? true : false;
  }

  public function resetPassword(User $user)
  {
    return $user->tokenCan(Abilities::ResetPassword);
  }
}
