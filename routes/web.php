<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;  
use Illuminate\Http\Request;  
use App\Models\Task;



Route::get('/', function ()  {
   return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index', [
        'tasksx' => Task::latest()->where('completed',true)->get() 
    ]);
})->name("tasks.index");

/*
Route::get("/{id}", function($id) {
  return 'one';
} )->name('task.show');
 */
Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get("/tasks/{task}/edit", function(Task $task)  {
  return view('edit', [
    'task' => $task
  ]);
} )->name('tasks.edit');



Route::get("/tasks/{task}", function(Task $task)  {
  return view('show', [
    'task' => $task
  ]);
} )->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'long_description' => 'required',
        
    ]); 

    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'] ?? null;
    $task->save();
    return redirect()->route('tasks.show', ['idx' => $task->id])
    ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, Request $request) {
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'long_description' => 'required',
        
    ]); 
    
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'] ?? null;
    $task->save();
    return redirect()->route('tasks.show', ['idx' => $task->id])
    ->with('success', 'Task updated successfully!');
})->name('tasks.update');

                            

/*
Route::get('/xxx', function () {
    return 'hello';
})->name('hello');

Route::get("/greet/{name}", function ($name) {
    return "Hello, $name!";
});

Route::get('/hallo', function () {
    return  redirect()->route('hello');
});

Route::fallback(function () {
    return 'Still here? You must have taken a wrong turn.';
 });
*/