<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLoanRequestController;
use App\Http\Controllers\BookLoanReturnsController;
use App\Http\Controllers\BookLoanListController;
use Illuminate\Support\Facades\Route;

Route::post('/book-loan-request', [BookLoanRequestController::class, 'store']);
Route::post('/returns/{loan_id}', [BookLoanReturnsController::class, 'store']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/loans', [BookLoanListController::class, 'index']);