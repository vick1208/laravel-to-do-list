<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TdlistContTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "abc",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Eko"
                ],
                [
                    "id" => "2",
                    "todo" => "Kurniawan"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Eko")
            ->assertSeeText("2")
            ->assertSeeText("Kurniawan");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "abc"
        ])->post("/todolist", [])
            ->assertSeeText("To Do is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "abc"
        ])->post("/todolist", [
            "todo" => "Eko"
        ])->assertRedirect("/todolist");
    }
    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "abc",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Eko"
                ],
                [
                    "id" => "2",
                    "todo" => "Kurniawan"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
