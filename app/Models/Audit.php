<?php

namespace App\Models;

use App\Traits\FilterableScope;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
  use FilterableScope;
  protected $fillable = [
    'staff_id',
    'action',
    'resources',
    'description',
    'created_by',
    'status',
  ];
}
