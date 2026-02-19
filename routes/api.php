<?php
use App\Http\Controllers\BookLoanRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/book-loan-requests', [BookLoanRequestController::class, 'index']);

Route::post('/book-loan-request', [BookLoanRequestController::class, 'store']);

