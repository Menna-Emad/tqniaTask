<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(AuthOtpController::class)->group(function()
{
  Route::get('/otp/login','login')->name('otp.login');
  Route::post('/otp/generate','generate')->name('otp.generate');
  Route::get('/otp/verification/{user_id}','verification')->name('otp.verification');
  Route::post('/otp/login','loginWithOtp')->name('otp.getlogin');
});
// Route::get('dashboard',[DashboardController::class,'index']);

Route::group(['prefix'=>'dashboard','middleware'=>'auth'],function(){
  Route::get('/',[DashboardController::class,'index']);
  Route::group(['prefix'=>'posts','as'=>'posts'],function(){
      Route::get('/',[PostController::class,'index'])->name('index');
      Route::post('store',[PostController::class,'store'])->name('store');
      //post 3lshan zy el form menf3sh hena n2olo en hygelk http request no3o get w fe el form ba3ten post f hy3ml error f hnkhly de zy el form ygelo post
      Route::get('create',[PostController::class,'create'])->name('create');
      //{id} da kda route parameter w bst2blo fe el function ely hya el edit fe ay variable ely hwa ana msmyhah id bardo
      Route::get('edit/{id}',[PostController::class,'edit'])->name('edit');
      Route::put('update/{id}',[PostController::class,'update'])->name('update');
      Route::delete('destroy/{id}',[PostController::class,'destroy'])->name('destroy');
      Route::post('posts/{post}/pin', [PostController::class, 'pin'])->name('posts.pin');
  });
});
Route::group(['prefix'=>'dashboard','middleware'=>'auth'],function(){
  Route::get('/',[DashboardController::class,'index']);
  Route::group(['prefix'=>'posts','as'=>'posts'],function(){
      Route::get('/',[TagController::class,'index'])->name('index');
      Route::post('store',[TagController::class,'store'])->name('store');
      //post 3lshan zy el form menf3sh hena n2olo en hygelk http request no3o get w fe el form ba3ten post f hy3ml error f hnkhly de zy el form ygelo post
      Route::get('create',[TagController::class,'create'])->name('create');
      //{id} da kda route parameter w bst2blo fe el function ely hya el edit fe ay variable ely hwa ana msmyhah id bardo
      Route::get('edit/{id}',[TagController::class,'edit'])->name('edit');
      Route::put('update/{id}',[TagController::class,'update'])->name('update');
      Route::delete('destroy/{id}',[TagController::class,'destroy'])->name('destroy');
      
  });
});



// Route::resource('dashboard',PostController::class);
  

Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
