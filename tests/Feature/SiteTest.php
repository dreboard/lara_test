<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /**
     *
     */
    public function setUp():void
    {
        parent::setUp();
        $this->user = $this->signIn();
    }

    public function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->create();
        $this->actingAs($user);
        return $user;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_see_home_page_by_logged_in_user()
    {
        $this->signIn();
        $response = $this->get('/home');
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_create_thread()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $thread = factory(Thread::class)->create([
            'user_id' => auth()->user()->id ?? factory('App\user')
        ])->toArray();
        /*

        */
        $array = [
            [1, 2],
            [1, 2]
        , [
        [2, 3],
        [2, 3]
    ]
];
        $thread2 = factory(Thread::class)->raw(
            ['user_id' => auth()->user()->id]
        );
        auth()->user()->threads()->create($thread2);
        $this->assertDatabaseHas('threads', $thread2);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest_cant_see_home_page()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    public function test_post_validation()
    {
        $this->withExceptionHandling();
        //$this->withoutExceptionHandling();
        $response = $this->postJson('/test', ['name' => '']);
        //$response->dump()->assertStatus(422);
        $response->assertStatus(422);
    }
}
