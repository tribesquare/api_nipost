<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends BaseRepository
{
    public function __construct()
    {
    }
    public function getModelClass(): Model
    {
        return new Role();
    }
}