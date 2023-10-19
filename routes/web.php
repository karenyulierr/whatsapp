<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Chat;
use App\Http\Controllers\ContactController;

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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware('auth')->resource('contacts', ContactController::class, ['names' => 'contacts']);

Route::get('prueba', function(){

    // $user = User::find(1);
    // $mesasages = $user->messages()->where(function($query){
    //     $query->where('chat_id',1)
    //           ->orWhere('chat_id',2);
    // })->get();

    // return $mesasages;

    //si tiene relacion o usuarios que han escrito un mensaje
    // $user = User::has('messages')->get();
    // return $user;

    // $user = User::whereHas('messages', function($query){
    //     $query->where('body',"chao");
    // })->get();
    // return $user;

    // $chats = Chat::whereHas('users', function($query){
    //     $query->where('users.id', 1);
    // })->get();
    $chats = Chat::whereHas('users', function($query){
        $query->where('users.id', 1);
    })->with('users')->get();
        
    return $chats;

});
