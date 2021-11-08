<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();



        /***************************************  Todo List ***************************************/

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/create-todoList', [App\Http\Controllers\HomeController::class, 'create'])->name('todoList.create');
        Route::post('/todoList', [App\Http\Controllers\HomeController::class, 'store'])->name('todoList.store');
        Route::get('/edit-todoList/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('todoList.edit');
        Route::patch('/update-todoList/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('todoList.update');
        Route::get('/delete-todoList/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('todoList.delete');
        Route::Delete('/delete-todoList/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('todoList.destroy');


        /***************************************  End Todo List ***************************************/



        /***************************************  Todo Tasks ***************************************/

        Route::get('taskLists/{id}', [App\Http\Controllers\TodoController::class, 'taskLists'])->name('taskLists');
        Route::get('createTasks/{id}', [App\Http\Controllers\TodoController::class, 'createTasks'])->name('taskLists.createTasks');
        Route::get('updateStatus/{id}', [App\Http\Controllers\TodoController::class, 'updateStatus'])->name('taskLists.updateStatus');
        Route::get('/delete-todoTask/{id}', [App\Http\Controllers\TodoController::class, 'delete'])->name('todoList.delete');
        Route::resource('/todo-tasks', TodoController::class);

        /***************************************  End Todo Tasks ***************************************/
