<?php

namespace Tests\Feature;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->json('POST', 'api/v1/login',
            [
                'email' => 'joao@joao.com',
                'password' => '123456'
            ]
        );
        $response->assertStatus(200);
    }

    public function test_loginFail()
    {
        $response = $this->json('POST', 'api/v1/login',
            [
                'email' => 'joao@joao.com',
                'password' => 'incorect'
            ]
        );
        $response->assertStatus(400);
    }

}
