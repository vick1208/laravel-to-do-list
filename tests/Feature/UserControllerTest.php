<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class UserControllerTest extends TestCase
{

    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "abc"
        ])->get('/login')
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "abc",
            "password" => "sosial"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "abc");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "abc"
        ])->post('/login', [
            "user" => "abc",
            "password" => "sosial"
        ])->assertRedirect("/");
    }

    public function testLoginValidationError()
    {
        $this->post("/login", [])
            ->assertSeeText("User or password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or password is incorrect");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "abc"
        ])->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }
    public function testGuestLogout()
    {
        $this->post('/logout')
            ->assertRedirect("/");
    }
}
