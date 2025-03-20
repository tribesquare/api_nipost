<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions\Abilities;

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

  public function update(User $user)
  {
    return $user->tokenCan(Abilities::UpdateUser) ? true : false;
  }
}
