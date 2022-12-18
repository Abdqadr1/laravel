<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DuskTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Employee');
        });
    }

    public function test_goto_forget_password()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Forgot Your Password?')
                ->clickLink('Forgot Your Password?')
                ->assertPathIs("/password/reset");
        });
    }
}
