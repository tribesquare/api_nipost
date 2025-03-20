<?php

namespace App\Http\Controllers\Api;

use App\Policies\RolePolicy;
use Throwable;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Filters\RoleFilter;
use App\Http\Resources\RoleResource;

class RolesController extends ApiController
{

  protected $policyClass = RolePolicy::class;
  /**
   * Display a listing of the resource.
   */
  public function index(RoleFilter $roleFilter)
  {
    try {
      $this->isAble('get', Role::class);
      return $this->ok('roles retrieved successfully', RoleResource::collection(Role::filter($roleFilter)->paginate()));
    } catch (Throwable $th) {
      $this->error($th->getMessage());
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
