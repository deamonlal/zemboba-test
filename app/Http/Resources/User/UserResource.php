<?php

namespace App\Http\Resources\User;

use App\Http\Requests\User\AuthRequest;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $request->toArray();
        return [
            'access_token' => $data['access_token'],
            'user_info' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'country' => $this->country,
                'city' => $this->city,
            ],
            'error' => '',
            'error_key' => ''
        ];
    }
}
