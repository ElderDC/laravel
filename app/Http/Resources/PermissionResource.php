<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'role_id'    => $this->role_id,
            'module_id'  => $this->module_id,
            'action'     => $this->action,
            'scope'      => $this->scope,
            'slug'       => $this->slug,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'role'       => $this->whenLoaded('role'),
            'module'     => $this->whenLoaded('module'),
        ];
    }
}
