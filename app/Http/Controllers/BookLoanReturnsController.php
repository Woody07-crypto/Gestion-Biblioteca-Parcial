<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookLoanReturnsController extends Controller
{

    public function store(int $loanId): JsonResponse
    {
        $loan = Loan::query()->find($loanId);

        if (! $loan) {
            return response()->json(['message' => 'Préstamo no encontrado.'], 404);
        }

         if ($loan->fecha_devolucion !== null || $loan->estado === 'devuelto') {
            return response()->json([
                'message' => 'Este préstamo ya fue devuelto.',
            ], 422);
        }

        $loan = DB::transaction(function () use ($loan) {
             $loan->fecha_devolucion = now();
            $loan->estado = 'devuelto';
            $loan->save();

             $book = DB::table('books')
                ->lockForUpdate()
                ->find($loan->book_id);

            if ($book) {
                $nuevasCopias = $book->Copias_disponibles + 1;

                DB::table('books')
                    ->where('id', $book->id)
                    ->update([
                        'Copias_disponibles' => $nuevasCopias,
                        'Estado'             => 'disponible',
                        'updated_at'         => now(),
                    ]);
            }

            return $loan;
        });

        return response()->json($loan, 200);
    }
}
