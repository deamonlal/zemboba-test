<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_the_app_returns_successfully_response_with_right_parameters(): void
    {
        $response = $this->call('GET', '/api/user_auth', [
            'access_token' => '07b38cd0e778340eb40b25e005476ce8',
            'city' => 'Москва',
            'country' => 'Россия',
            'first_name' => 'Иван',
            'id' => 1,
            'last_name' => 'Иванов',
            'sig' => 'e37aed44e458af3e19a7f76add7cb43f'
        ]);

        $response->assertStatus(200);
    }

    public function test_app_returns_401_status_code_when_sig_is_wrong(): void
    {
        $response = $this->call('GET', '/api/user_auth', [
            'access_token' => '07b38cd0e778340eb40b25e005476ce8',
            'city' => 'Москва',
            'country' => 'Россия',
            'first_name' => 'Иван',
            'id' => 1,
            'last_name' => 'Иванов',
            'sig' => '623123123123213e3dbd'
        ]);

        $response->assertStatus(401);
    }

    public function test_app_returns_400_status_code_when_sig_is_invalid_type(): void
    {
        $response = $this->call('GET', '/api/user_auth', [
            'access_token' => '07b38cd0e778340eb40b25e005476ce8',
            'city' => 'Москва',
            'country' => 'Россия',
            'first_name' => 'Иван',
            'id' => 1,
            'last_name' => 'Иванов',
            'sig' => 1
        ]);

        $response->assertStatus(400);
    }
}
