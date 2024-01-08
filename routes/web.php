<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

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
    return view('dashboard');
});
Route::get('/login', [PageController::class, 'showLogin'])->name('login');
Route::post('/login', [PageController::class, 'login']);
Route::get('/register', [PageController::class, 'showRegister'])->name('register');
Route::post('/register', [PageController::class, 'register']);
Route::get("/logout", [UserController::class, "logoutuser"]);
Route::post("/registerakun",[UserController::class, "registerakun"]);
Route::post('/loginuser', [UserController::class, "login"]);

//untuk Admin
Route::prefix("/admin")->group(function(){
    Route::view("/","admin.homeAdmin" );
    Route::get("/listuser", [UserController::class, "listUser"]);
    Route::get("/listbaker", [UserController::class, "listBaker"]);
    Route::get("/listkaryawan", [UserController::class, "listKaryawan"]);
    Route::match(['get', 'post'], "/registerakunbaker", [UserController::class, "registerakunbaker"])
    ->name('registerakunbaker');
    Route::match(['get', 'post'], "/registerakunkaryawan", [UserController::class, "registerakunkaryawan"])
    ->name('registerakunkaryawan');
    Route::get("/masterbaker", [UserController::class, "viewmasterbaker"]);
    Route::get("/masterkaryawan", [UserController::class, "viewmasterkaryawan"]);
});

// Untuk User
Route::prefix("/user")->group(function(){
    Route::get("/",[UserController::class, 'tampilhomeuser'] );
    Route::get("/dashboard", [UserController::class, 'tampilhomeuser'] );
    Route::get("/listmenu", [UserController::class, 'tampillistmenu'] );
    Route::get("/profile", [UserController::class, 'tampilProfile'])->name("profile");
    Route::get("/HEditProfile", [UserController::class, 'HUEditProfile']);
    Route::post("/PUEditProfile",[UserController::class, "PUEditProfile"]);
    Route::get("/membership",[UserController::class, "tampilHMembership"])->name("Hprofile");
    Route::post("/belimembership", [UserController::class, "beliMembership"]);
    Route::post("/topup", [UserController::class, "topup"]);
    Route::get("/topup", [UserController::class, "showTopupPage"])->name("topup");
});

Route::prefix("/baker")->group(function(){
    Route::get("/",[UserController::class, 'tampilhomebaker'] );
    Route::get("/mastermenu", [UserController::class, "viewmastermenu"]);
    Route::get("/mastersupplier", [UserController::class, "viewmastersupplier"]);
    Route::get("/masteringredient", [UserController::class, "viewmasteringredient"]);
    Route::match(['get', 'post'], "/insertsupplier", [UserController::class, "insertsupplier"])
    ->name('insertsupplier');
    Route::match(['get', 'post'], "/insertIngredient", [UserController::class, "insertIngredient"])
    ->name('insertIngredient');
    Route::match(['get', 'post'], "/insertpastry", [UserController::class, "insertpastry"])
    ->name('insertpastry');
});

Route::prefix("/karyawan")->group(function(){
    Route::get("/",[UserController::class, 'tampilhomekaryawan'] );
});
