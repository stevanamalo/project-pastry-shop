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
Route::prefix("/admin")->name("admin")->group(function(){
    Route::view("/","admin.homeAdmin" );
    Route::get("/listuser", [UserController::class, "listUser"]);
    Route::get("/listbaker", [UserController::class, "listBaker"]);
    Route::match(['get', 'post'], "/registerakunbaker", [UserController::class, "registerakunbaker"])
    ->name('registerakunbaker');
    Route::get("/masterbaker", [UserController::class, "viewmasterbaker"]);
});

// Untuk User
Route::prefix("/user")->group(function(){
    Route::get("/",[UserController::class, 'tampilhomeuser'] );
    Route::get("/dashboard", [UserController::class, 'tampilhomeuser'] );
    Route::get("/profile", [UserController::class, 'tampilProfile'])->name("profile");
    Route::get("/HEditProfile", [UserController::class, 'HUEditProfile']);
    Route::post("/PUEditProfile",[UserController::class, "PUEditProfile"]);
    Route::get("/membership",[UserController::class, "tampilHMembership"])->name("Hprofile");
    Route::post("/belimembership", [UserController::class, "beliMembership"]);
    Route::post("/topup", [UserController::class, "topup"]);
    Route::get("/topup", [UserController::class, "showTopupPage"])->name("topup");
});
