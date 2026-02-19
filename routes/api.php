<?php
use App\Http\Controllers\BookLoanRequestController;
use Illuminate\Support\Facades\Route;

Route::post('/book-loan-request', [BookLoanRequestController::class, 'store']);

