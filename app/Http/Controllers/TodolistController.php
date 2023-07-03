<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList(Request $request)
    {
        $tdlist = $this->todolistService->getTodo();
        return response()->view("tdlist.todolist", [
            "title" => "Todolist",
            "todolist" => $tdlist
        ]);
    }
    public function insTodo(Request $request)
    {
        $td = $request->input("todo");
        if (empty($td)) {
            $tdlist = $this->todolistService->getTodo();
            return response()->view('tdlist.todolist', [
                "title" => "Todolist",
                "todolist" => $tdlist,
                "error" => "To Do is required"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(),$td);

        return redirect()->action([TodolistController::class,'todoList']);
    }
    public function delTodo(Request $request, string $todoId):RedirectResponse
    {
        $this->todolistService->delTodo($todoId);
        return redirect()->action([TodolistController::class,'todoList']);
    }
}
