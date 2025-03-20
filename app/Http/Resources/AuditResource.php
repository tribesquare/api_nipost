<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'staff_id' => $this->staff_id,
            'action' => $this->action,
            'created_by' => $this->created_by,
            'resources' => $this->resources,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
