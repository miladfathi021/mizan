<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function The_visitor_can_see_the_homepage()
    {
        $this->withoutExceptionHandling();

        $this->get('/')->assertSee('میزان');
    }
}
