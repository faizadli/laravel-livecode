<?php

use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\UserController;
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
    return view('welcome');
});

Route::get('/backend/manage/post', [PostController::class, 'index'])->name("backend.manage.post");
Route::get('/backend/create/post', [PostController::class, 'create'])->name("backend.create.post");
Route::post('/backend/create/process/post', [PostController::class, 'create_process'])->name("backend.create.process.post");
Route::get('/backend/show/post/{post}', [PostController::class, 'show'])->name('backend.show.post');
Route::get('/backend/edit/post/{post}', [PostController::class, 'edit'])->name('backend.edit.post');
Route::post('/backend/edit/post/{post}', [PostController::class, 'edit_process'])->name('backend.edit.process.post');
Route::delete('/backend/delete/{post}', [PostController::class, 'destroy'])->name('backend.delete.post');

Route::get('/backend/manage/user', [UserController::class, 'index'])->name("backend.manage.user");
Route::get('/backend/create/user', [UserController::class, 'create'])->name("backend.create.user");
Route::post('/backend/create/process/user', [UserController::class, 'create_process'])->name("backend.create.process.user");
Route::get('/backend/edit/user/{id?}', [UserController::class, 'edit'])->name("backend.edit.user");
Route::post('/backend/edit/process/user', [UserController::class, 'edit_process'])->name("backend.edit.process.user");
Route::delete('/backend/destroy/process/user/{id?}', [UserController::class, 'destroy'])->name("backend.destroy.process.user");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
