<?php

declare(strict_types=1);

namespace App\Contract;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

interface Filterable
{
    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder;
}