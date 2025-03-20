<?php

namespace App\Traits;

trait General
{
  public function passwordGenerator($length = 8)
  {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    return substr(
      str_shuffle($chars),
      0,
      $length
    );
  }
}
