<?php
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;  
use Illuminate\Http\Request;  
use App\Models\Task;



Route::get('/', function ()  {
   return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index', [
        'tasksx' => Task::latest()->paginate() 
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

Route::post('/tasks', function (TaskRequest $request) {
 // $data = $request->validated();  
  //  $task = new Task();
  //  $task->title = $data['title'];
  //  $task->description = $data['description'];
  //  $task->long_description = $data['long_description'] ?? null;
  //  $task->save();
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {

   // $data = $request->validated();
   // $task->title = $data['title'];
  //  $task->description = $data['description'];
   // $task->long_description = $data['long_description'] ?? null;
  //  $task->save();
  $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task updated successfully!');
})->name('tasks.update');


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
    ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');
                            

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