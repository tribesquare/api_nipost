<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
  public function getModelClass(): Model
  {
    return new User();
  }
}
