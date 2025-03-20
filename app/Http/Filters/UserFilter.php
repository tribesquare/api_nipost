<?php

namespace App\Http\Filters;

use App\Enums\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends QueryFilter
{
  protected array $sortable = [
    'id' => 'id',
    'name' => 'name',
    'email' => 'email',
    'created_at' => 'created_at',
    'updated_at' => 'updated_at',
  ];

  public function applyRoleBasedRestriction()
  {
    $user = Auth::user();
    if (in_array($user->role->slug, [Roles::USER->value, Roles::ADMIN->value])) {
      $this->builder->where('id', $user->id);
    }

    return $this;
  }

  public function apply(Builder $builder): Builder
  {
    parent::apply($builder);

    // Auto-call role-based restriction here
    $this->applyRoleBasedRestriction();

    return $builder;
  }

  public function createdAt($value)
  {
    $dates = explode(',', $value);

    if (count($dates) > 1) {
      return $this->builder->whereBetween('created_at', $dates);
    }

    return $this->builder->whereDate('created_at', $value);
  }

  public function include($value)
  {
    return $this->builder->with($value);
  }

  public function status($value)
  {
    return $this->builder->whereIn('status', explode(',', $value));
  }

  public function name($value)
  {
    $likeStr = str_replace('*', '%', $value);
    return $this->builder->where('name', 'like', $likeStr);
  }

  public function updatedAt($value)
  {
    $dates = explode(',', $value);

    if (count($dates) > 1) {
      return $this->builder->whereBetween('updated_at', $dates);
    }

    return $this->builder->whereDate('updated_at', $value);
  }
}
