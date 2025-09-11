<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Task;



Route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function(){
    return view('index', [
        // 'tasks'=> Task::all()
        'tasks'=> Task::latest()->paginate(5)
        // 'tasks'=> Task::latest()->where('completed', false)->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('create');

Route::get('/tasks/{id}', function($id){
    return view('show', ['task'=> Task::findorFail($id)]);
})->name('tasks.show');

Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.edit');


Route::post('/tasks', function(TaskRequest $request){
   $task =  Task::create($request->validated());
   return redirect()->route('tasks.show', ['id'=> $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');


Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');