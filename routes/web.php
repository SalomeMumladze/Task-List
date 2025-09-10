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
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}', function($id){
    return view('show', ['task'=> Task::findorFail($id)]);
    
})->name('tasks.show');

//post - fecth data
//put - modifie