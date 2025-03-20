<?php

declare(strict_types=1);

namespace App\Repositories;

use Exception;
use App\Contract\Filterable;
use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository
{
  private Model $model;

  public function __construct()
  {
    $this->model = $this->getModelClass();
  }

  abstract public function getModelClass(): Model;

  public function all(): Collection
  {
    return $this->model->all();
  }

  public function find(int $id): Model
  {
    return $this->model->findOrFail($id);
  }

  public function create(array $attributes): Model
  {
    return $this->model->create($attributes);
  }

  public function update(int $id, array $attributes): Model
  {
    $model = $this->find($id);
    $model->update($attributes);

    return $model->fresh();
  }

  public function delete(int $id): bool
  {
    $model = $this->find($id);
    $model->delete();

    return true;
  }

  public function findByWhere($column, $value, $all = false): Model|Collection|null
  {
    $query = $this->model->where($column, $value);

    if (! $all) {
      return $query->first();
    }

    return $query->all();
  }

  public function count($key, $value)
  {
    return $this->model->where($key, $value)->count();
  }

  public function paginate($number)
  {
    return $this->model->latest()->paginate($number);
  }

  public function showFolder($key)
  {
    return $this->model
      ->whereJsonContains($key, auth('sanctum')->user()->uuid)
      ->orderBy('id', 'desc')
      ->get();
  }

  public function where(string $column, string $value): Model
  {
    return $this->model->where($column, $value);
  }

  public function whereArray(array $payload): mixed
  {
    return $this->model->where($payload)->first();
  }

  public function whereIn(string $column, array $values): Model
  {
    return $this->model->whereIn($column, $values);
  }

  public function updateMany(string $column, array $values, array $attributes): bool
  {
    return $this->model->whereIn($column, $values)
      ->update($attributes);
  }

  public function exists(array $attributes): bool
  {
    return $this->model->where($attributes)->exists();
  }

  /**
   * @throws Exception
   */
  public function setFilters(QueryFilter $filters)
  {
    if (! $this->model instanceof Filterable) {
      throw new  Exception('You need to implement Filterable Contract on the model you are filtering!');
    }

    return $this->model->filter($filters);
  }

  /**
   * @throws Exception
   */
  public function getAllWithFilters(QueryFilter $filters, array $with = [])
  {
    return $this->setFilters($filters)
      ->with($with)
      ->get();
  }

  public function findAgentsOnly(?int $id = null): Collection
  {
    $query = $this->model->where('type', 'agent');

    if ($id) {
      $query->where('id', $id);
    }

    return $query->get();
  }
}
