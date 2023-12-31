<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeContTest extends TestCase
{
    public function testGuest()
    {
        $this->get("/home")
            ->assertRedirect("/login");
    }
    public function testMember()
    {
        $this->withSession(["user" => "abc"])
            ->get("/home")->assertRedirect("/todolist");
    }
}
