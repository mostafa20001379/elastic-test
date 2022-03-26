<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(type="object", schema="App\Http\Resources\Notification\Notification")
 */

class Notification extends JsonResource
{
    /**
     * @OA\Property(property="user_id",type="integer")
     * @OA\Property(property="platform",type="string")
     * @OA\Property(property="in_queue",type="boolean")
     * @OA\Property(property="send_at",type="string",format="date-time")
     * @OA\Property(property="read_at",type="string",format="date-time")
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'platform' => $this->platform,
            'in_queue' => $this->in_queue,
            'send_at' => $this->send_at,
            'received_at' => $this->received_at,
            'read_at' => $this->read_at
        ];
    }
}