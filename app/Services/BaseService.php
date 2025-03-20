<?php

namespace App\Services;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
  public function __construct(protected $repository) {}
  public function create(array $data): Model
  {
    return $this->repository->create($data);
  }

  public function update(int $id, array $data)
  {
    return $this->repository->update($id, $data);
  }

  /**
   * @throws \Exception
   */
  public function fetchAll(QueryFilter $filter, array $with = [])
  {
    return $this->repository->getAllWithFilters($filter, $with);
  }

  public function paginate($number)
  {
    return $this->repository->paginate($number);
  }
}
