<?php

namespace App\Http\Resources\Users\Lands;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LandsIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $location =null;
        if ($this->location){
            $location = json_decode($this->location, false, 512, JSON_THROW_ON_ERROR);
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'location' => $location,
            'area' => $this->area,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
