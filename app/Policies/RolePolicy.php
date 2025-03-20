<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions\Abilities;

class RolePolicy
{
  /**
   * Create a new policy instance.
   */
  public function __construct()
  {
    //
  }

  public function get(User $user) {
    return $user->tokenCan(Abilities::GetRole);
}
}
