<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Apis\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');



Route::prefix('posts')->group(function () {
    Route::get('/',[PostController::class,'index']);
    Route::get('/create',[PostController::class,'create']);
    Route::get('/edit/{id}',[PostController::class,'edit']);
    //hn3ml url tany aw route esmha store 3lshan lma ados 3la create akhznha
    //bs no3ha post 3lshan lma ados 3la el zorar tshtaghl w el data ely htgely fe el body ha3ml 3leha validate
    Route::post('/store',[PostController::class,'store']);
    Route::put('/update/{id}',[PostController::class,'update']);
    Route::delete('/destroy/{id}',[PostController::class,'destroy']);
});


Route::prefix('tags')->group(function () {
    Route::get('/',[TagController::class,'index']);
    Route::get('/create',[TagController::class,'create']);
    Route::get('/edit/{id}',[TagController::class,'edit']);
    //hn3ml url tany aw route esmha store 3lshan lma ados 3la create akhznha
    //bs no3ha post 3lshan lma ados 3la el zorar tshtaghl w el data ely htgely fe el body ha3ml 3leha validate
    Route::post('/store',[TagController::class,'store']);
    Route::put('/update/{id}',[TagController::class,'update']);
    Route::delete('/destroy/{id}',[TagController::class,'destroy']);
});
