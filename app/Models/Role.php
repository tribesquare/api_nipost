<?php

namespace App\Models;

use App\Traits\FilterableScope;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use FilterableScope;
  protected $fillable = [
    'uuid',
    'name',
    'slug',
    'description',
  ];

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
