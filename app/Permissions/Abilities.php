<?php

namespace App\Permissions;

use App\Models\User;

final class Abilities
{
  public const CreateParcel = 'Parcel:create';
  public const UpdateParcel = 'Parcel:update';
  public const DeleteParcel = 'Parcel:delete';

  public const CreateOwnParcel = 'Parcel:own:create';
  public const UpdateOwnParcel = 'Parcel:own:update';
  public const DeleteOwnParcel = 'Parcel:own:delete';

  public const CreateUser = 'staff:create';

  public const ViewAnyUser = 'staff:viewAny';

  public const ViewUser = 'staff:view';
  public const UpdateUser = 'staff:update';
  public const ReplaceUser = 'staff:replace';
  public const DeleteUser = 'staff:delete';

  public const ResetPassword = 'staff:resetPassword';

  public const GetAudit = 'audit:get';

  public static function getAbilities(User $user)
  {
    // don't assign '*'
    $rules = [];
    if ($user->role_id === 3) {
      $rules[] = self::GetAudit;
    }
    if ($user->role_id === 2 || $user->role_id === 3) {
      return array_merge($rules, [
        self::CreateParcel,
        self::UpdateParcel,
        self::DeleteParcel,
        self::CreateUser,
        self::UpdateUser,
        self::ReplaceUser,
        self::DeleteUser,
        self::ViewAnyUser,
        self::ResetPassword
      ]);
    } else {
      return [
        self::CreateOwnParcel,
        self::UpdateOwnParcel,
        self::DeleteOwnParcel,
        self::CreateParcel,
        self::ViewUser
      ];
    }
  }
}
