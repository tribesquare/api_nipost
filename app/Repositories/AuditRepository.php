<?php

namespace App\Repositories;

use App\Models\Audit;
use Illuminate\Database\Eloquent\Model;

class AuditRepository extends BaseRepository
{
  public function getModelClass(): Model
  {
    return new Audit();
  }
}
