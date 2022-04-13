<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\RegistrationController;

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

Route::get('/', [GoodController::class, 'index']);
Route::get('/goods/{good}', [GoodController::class, 'show'])->name('goods.show'); // Роут страницы карточки товара
Route::post('/store', [RegistrationController::class, 'store'])->name('register'); // Роут регистрации

