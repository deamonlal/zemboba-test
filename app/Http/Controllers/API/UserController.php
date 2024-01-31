<?php

namespace App\Http\Controllers\API;

use App\Actions\SignatureVerificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Creates or updates User and his UserSession and show its data
     * @param AuthRequest $request
     * @param SignatureVerificationAction $verification
     * @return JsonResponse
     */
    public function __invoke(AuthRequest $request, SignatureVerificationAction $verification): JsonResponse
    {
        $data = $request->validated();
        $verification($data);
        $newAccessToken = $data['access_token'];
        $user = User::find($data['id']);
        if(!isset($user)) {
            $user = User::create($data);
            UserSession::create([
                'user_id' => $user->id,
                'access_token' => $newAccessToken
            ]);
        } else {
            $user->update($data);
            $user->userSession->update([
                'user_id' => $user->id,
                'access_token' => $newAccessToken
            ]);
        }
        return UserResource::make($user)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_OK);
    }
}
