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
}
