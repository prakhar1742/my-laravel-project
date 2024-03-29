<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\SolariumController;

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
Route::get("/about",function(){
     echo "about us";

     
});
Route::get("/", [BookController::class, "index"])->name("booklist");
Route::get("/store",[BookController::class, "stare"])->name('add.user');
Route::post("/store",[BookController::class, "store"]);
Route::get("/update",function(){
    return view("books.update");
});
Route::get("/update/{id}/{page?}",[BookController::class,"updated"])->name('update');
Route::get("/delete/{id}",[BookController::class, "delete"])->name("delete");
Route::put("/update/{id}/{page?}",[BookController::class,"update1"])->name("updatebook");
Route::get("search",[BookController::class,"search"])->name("search");

Route::get("/login",function(){
    $message=session("message") ?? null;
    return view('login',["message"=>$message]); });
Route::post("/login",[LoginController::class, "index"])->name('login');
Route::post('/signup',[LoginController::class,"store"])->name('signup');
Route::get('/signup',function(){return view("books.signup");});
Route::get('/logout', function () {return view('logout');})->name('logout');
Route::post('/logout',[LoginController::class,"logout"])->name("Logout");

Route::get("/users",[LoginController::class,"Users"])->middleware("admin");
Route::get("/unauthorised",function(){return view("unauthorised");});

Route::get("/users/{username}",[BookController::class,"username"]);


Route::get("/ajax",[AjaxController::class,"index"]);
Route::get("/ajax/data",[AjaxController::class,"data"]);
Route::post("/ajax/show",[BookController::class,"show"]);


Route::get('/ping',[SolariumController::class,"ping"]);
Route::get("/query",function(){return view("query");});
Route::get("/adddata",function(){return view("solrinput");});
Route::post("/submit",[SolariumController::class,"addData"]);
Route::get("/submit/{idd}/{searchh}",[SolariumController::class,"search"]);
