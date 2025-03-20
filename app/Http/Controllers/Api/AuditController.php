<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\Audit;
use App\Policies\AuditPolicy;
use App\Services\AuditService;
use App\Http\Filters\AuditFilter;
use App\Http\Resources\AuditResource;
use App\Http\Controllers\Api\ApiController;

class AuditController extends ApiController
{
  protected $policyClass = AuditPolicy::class;

  public function __construct(protected AuditService $auditService) {}
  /**
   * Display a listing of the resource.
   */
  public function index(AuditFilter $filters)
  {
    try {
      // policy
      $this->isAble('get', Audit::class);
      return $this->ok('audit retrieved successfully', AuditResource::collection(Audit::filter($filters)->paginate()));
    } catch (Throwable $th) {
      $this->error($th->getMessage());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Audit $audit)
  {
    //
  }
}
