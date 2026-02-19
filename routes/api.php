<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLoanRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/books', [BookController::class, 'index']);

Route::get('/book-loan-requests', [BookLoanRequestController::class, 'index']);

Route::post('/book-loan-request', [BookLoanRequestController::class, 'store']);

