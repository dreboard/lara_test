<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutUser extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create();
        $lastActivityTime = time();
        $expired = $lastActivityTime + 12000;
        $this->session(['lastActivityTime' => $lastActivityTime]);

        $response = $this
            ->actingAs($user, 'web')
            ->withMiddleware(\App\Http\Middleware\SessionLogout::class)
            ->withSession(['lastActivityTime' => $expired])
            ->get('/user');

        //dd(session()->all());
        $response->assertStatus(302);
    }

}
