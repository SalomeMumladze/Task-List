<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::view('/tasks/create', 'create')->name('create');

Route::get('/tasks/{id}', function($id){
    return view('show', ['task'=> Task::findorFail($id)]);
    
})->name('tasks.show');

Route::post('/tasks', function(Request $request){
   $data = $request->validate([
        'title'=>'required|max:255',
        'description'=>'required',
        'long_description'=>'required',
   ]);

   $task = new Task;
   $task->title=$data['title'];
   $task->description=$data['description'];
   $task->long_description=$data['long_description'];
   $task -> save();

   return redirect()->route('tasks.show', ['id'=> $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');

//post - fecth data
//put - modifie