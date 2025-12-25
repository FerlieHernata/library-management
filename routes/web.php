<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/health', function () {
    return response('OK', 200);
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| USER & ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* ================= USER ================= */

    Route::get('/', [BookController::class, 'index'])
        ->name('home');

    Route::post('/borrow/{id}', [BorrowController::class, 'store'])
        ->name('borrow');

    Route::get('/my-borrow', function (Request $request) {
        $borrows = $request->user()->borrows;
        return view('borrows.index', compact('borrows'));
    })->name('my.borrow');

    Route::post('/return/{id}', [BorrowController::class, 'returnBook'])
        ->name('return');

    /* ================= ADMIN ================= */

    Route::middleware('admin')->group(function () {
        Route::resource('books', BookController::class)
            ->except(['index', 'show']);
    });
});
