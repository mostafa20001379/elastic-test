<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="App\Http\Requests\Elastic\IndexRequest",
 *     type="object"
 * )
 */
class IndexRequest extends FormRequest
{
    /**
     * @OA\Property(property="platform",type="string", example="instagram")
     * @OA\Property(property="datetime",type="date", nullable=true, example="2001-01-01")
     * @OA\Property(property="title",type="string", nullable=true, example="Hey")
     * @OA\Property(property="username",type="string", nullable=true, example="Adam")
     * @OA\Property(property="name",type="string", nullable=true, example="Adam")
     */

    public function rules()
    {
        return [
            'platform' => 'required',
            'datetime' => 'date',
            'title' => 'nullable|string',
            'username' => 'nullable|string',
            'name' => 'nullable|string'
        ];
    }

}
