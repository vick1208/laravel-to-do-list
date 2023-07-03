<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class TdlistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp():void{
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodoNotNull() : void {
        assertNotNull($this->todolistService);
    }
    public function testSavingTodo()
    {
        $this->todolistService->saveTodo("1", "Eko");

        $todolist = Session::get("todolist");
        foreach ($todolist as $value){
            assertEquals("1", $value['id']);
            assertEquals("Eko", $value['todo']);
        }
    }
    public function testGetTodoEmpty(){
        assertEquals([],$this->todolistService->getTodo());
    }
    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "Eko"
            ],
            [
                "id" => "2",
                "todo" => "Kurniawan"
            ]
        ];

        $this->todolistService->saveTodo("1", "Eko");
        $this->todolistService->saveTodo("2", "Kurniawan");

        assertEquals($expected, $this->todolistService->getTodo());
    }
    public function testRemovingTodo()
    {
        $this->todolistService->saveTodo("1", "Eko");
        $this->todolistService->saveTodo("2", "Kurniawan");
        $this->todolistService->saveTodo("3", "Rudi");

        assertEquals(3, sizeof($this->todolistService->getTodo()));

        $this->todolistService->delTodo("3");

        assertEquals(2, sizeof($this->todolistService->getTodo()));

        $this->todolistService->delTodo("1");

        assertEquals(1, sizeof($this->todolistService->getTodo()));

        $this->todolistService->delTodo("2");

        assertEquals(0, sizeof($this->todolistService->getTodo()));
    }

}
