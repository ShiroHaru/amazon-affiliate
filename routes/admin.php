<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

//管理画面用にurlに /admin 以下で全てのページにアクセスする
Route::prefix('/admin')->group(function () {
  //breezeによって自動的に作られるダッシュボードトップ
  // Route::get('/dashboard', function () {
  //   return view('dashboard');
  // })->middleware(['auth', 'verified'])->name('dashboard');

  //admin直下をダッシュボードに変更
  Route::get('/', function () {
    return view('dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');


  //ログインユーザーのみアクセス可能
  Route::middleware('auth')->group(function () {
    //プロフィール関連
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //adminLTE
    Route::get('adminlte', function () {
      return view('adminlte');
    });

    Route::resource('examples', 'Admin\ExampleController');

    //category
    Route::resource('categories', 'Admin\CategoryController');

    //origin
    Route::resource('origins', 'Admin\OriginController');

    //imports
    Route::get('/import/feature', 'Admin\ImportController@feature');
    Route::post('/import/store', 'Admin\ImportController@store');
  });

  //🍔Exampleサンプル
});

//管理画面用のルーティング /routes/auth.phpを読み込む
require __DIR__ . '/auth.php'; //
