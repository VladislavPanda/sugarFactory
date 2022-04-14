<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabinetController;

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
Route::get('/register', [RegistrationController::class, 'index'])->name('register.index'); // Роут страницы регистрации
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store'); // Роут регистрации
Route::get('/signin', [AuthController::class, 'index'])->name('signin.index'); // Роут страницы авторизации
Route::post('/signin', [AuthController::class, 'login'])->name('signin.store'); // Роут авторизации

Route::middleware('auth')->prefix('cabinet')->group(function(){
    Route::get('/orders', [CabinetController::class, 'index'])->name('cabinet.index');
    /*Route::get('/appointment/procedures/{id}', [AppointmentController::class, 'getProcedures'])->name('procedures_modal');*/
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});