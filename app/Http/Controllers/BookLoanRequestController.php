<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

class BookLoanRequestController extends Controller
{
    public function store(StoreLoanRequest $request)
    {
        $loan = DB::transaction(function () use ($request) {
            $book = DB::table('books')
                ->lockForUpdate()
                ->find($request->book_id);

            if (! $book || $book->Copias_disponibles <= 0) {
                abort(422, 'No hay existencias de este libro.');
            }

            $loan = Loan::create([
                'user_id'        => $request->user_id,
                'book_id'        => $request->book_id,
                'fecha_prestamo' => now(),
                'estado'         => 'prestado',
            ]);

            $nuevasCopias = $book->Copias_disponibles - 1;

            DB::table('books')
                ->where('id', $book->id)
                ->update([
                    'Copias_disponibles' => $nuevasCopias,
                    'Estado'             => $nuevasCopias === 0 ? 'no_disponible' : 'disponible',
                    'updated_at'         => now(),
                ]);

            return $loan;
        });

        return response()->json($loan, 201);
    }
}
