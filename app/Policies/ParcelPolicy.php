<?php

namespace App\Policies;

use App\Models\Parcel;
use App\Models\User;
use App\Permissions\Abilities;

class ParcelPolicy
{
  /**
   * Create a new policy instance.
   */
  public function __construct()
  {
    //
  }
  public function delete(User $user, Parcel $parcel)
  {
    if ($user->tokenCan(Abilities::DeleteParcel)) {
      return true;
    } else if ($user->tokenCan(Abilities::DeleteOwnParcel)) {
      return $user->id === $parcel->user_id;
    }

    return false;
  }

  public function replace(User $user, Parcel $parcel)
  {
    if ($user->tokenCan(Abilities::UpdateParcel)) {
      return true;
    } else if ($user->tokenCan(Abilities::UpdateOwnParcel)) {
      return $user->id === $parcel->user_id;
    }

    return false;
  }

  public function store(User $user)
  {
    return $user->tokenCan(Abilities::CreateParcel) ||
      $user->tokenCan(Abilities::CreateOwnParcel);
  }

  public function update(User $user, Parcel $parcel)
  {
    if ($user->tokenCan(Abilities::UpdateParcel)) {
      return true;
    } else if ($user->tokenCan(Abilities::UpdateOwnParcel)) {
      return $user->id === $parcel->user_id;
    }

    return false;
  }
}
