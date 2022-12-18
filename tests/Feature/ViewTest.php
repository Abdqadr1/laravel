<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_homepage()
    {
        $response = $this->get('/')
            ->assertStatus(302)
            ->assertRedirect('/login');

        $this->followRedirects($response)
            ->assertSeeText("Login");
    }

    public function test_goto_forget_password()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee("Forgot Your Password?");
    }
}
