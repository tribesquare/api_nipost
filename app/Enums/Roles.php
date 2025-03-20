<?php

namespace App\Enums;

enum Roles: string {
  case SUPER_ADMIN = 'super-admin';
  case ADMIN = 'admin';
  case USER = 'user';
}