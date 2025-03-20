<?php

namespace App\Services;

use App\Repositories\AuditRepository;

class AuditService extends BaseService
{
  public function __construct(protected AuditRepository $auditRepository)
  {
    parent::__construct($auditRepository);
  }

  public function log($payload)
  {
    return $this->repository->create($payload);
  }

  
}
