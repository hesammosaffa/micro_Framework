<?php

namespace App\Controllers;

use App\Utilities\Asset;

class TodoController
{
    public function list()
    {
        $tasks = [
            'First Task',
            'Second Task',
            'Third Task',
            'Test Task',
            'Another Task',

        ];

        $data = [
            'tasks' => $tasks,
            'title' => 'لیست تسک ها'
        ];


        Asset::view('todo.list', $data);
    }
}
