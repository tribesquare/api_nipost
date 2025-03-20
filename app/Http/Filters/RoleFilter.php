<?php

namespace App\Http\Filters;

class RoleFilter extends QueryFilter
{

  protected array $sortable = [];
  public function name($name)
  {
    return $this->builder->where('name', $name);
  }
}