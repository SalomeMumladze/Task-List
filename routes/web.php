<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Models\Task;



Route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function(){
    return view('index', [
        'tasks'=> Task::all()
        // 'tasks'=> Task::latest()->get() most recent tasks first
        // 'tasks'=> Task::latest()->where('completed', false)->get()
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}', function($id){
    return view('show', ['task'=> Task::findorFail($id)]);
    
})->name('tasks.show');

//post - fecth data
//put - modifie