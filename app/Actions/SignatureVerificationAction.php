<?php

namespace App\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;

class SignatureVerificationAction
{
    /**
     * Verificate the signature of the request
     * @param $data
     * @return void
     */
    public function __invoke($data): void
    {
        ksort($data);
        $sig = $data['sig'];
        unset($data['sig']);
        $stringParams = implode('', $data) . getenv('APP_KEY');
        $str = mb_strtolower( md5($stringParams), 'UTF-8');
        if($str !== $sig) {
            throw new HttpResponseException(response()->json([
                'error'   => 'Ошибка авторизации в приложении',
                'error_key' => 'signature error'
            ])->setStatusCode(401));
        }
    }
}


