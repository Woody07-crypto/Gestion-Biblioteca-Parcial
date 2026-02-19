<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\Loan;
use Illuminate\Http\Request;

class BookLoanListController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['book', 'user']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->query('user_id'));
        }

        if ($request->filled('book_id')) {
            $query->where('book_id', $request->query('book_id'));
        }

        if ($request->filled('fecha_prestamo')) {
            $query->whereDate('fecha_prestamo', $request->query('fecha_prestamo'));
        }

        if ($request->filled('fecha_devolucion')) {
            $query->whereDate('fecha_devolucion', $request->query('fecha_devolucion'));
        }

        if ($request->filled('estado')) {
            $query->where('estado', 'like', '%' . $request->query('estado') . '%');
        }

        if ($request->filled('status')) {
            $status = filter_var(
                $request->query('status'),
                FILTER_VALIDATE_BOOLEAN,
                FILTER_NULL_ON_FAILURE
            );

            if ($status === true) {
                $query->whereNull('fecha_devolucion');
            } elseif ($status === false) {
                $query->whereNotNull('fecha_devolucion');
            }
        }

        $loans = $query->get();

        return LoanResource::collection($loans);
    }
}
