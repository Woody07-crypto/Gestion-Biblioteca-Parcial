<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * GET /api/books
     *
     * Filtros:
     * - ?titulo=...
     * - ?isbn=...
     * - ?status=true|false|1|0
     */
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('titulo')) {
            $query->where('Titulo', 'like', '%' . $request->query('titulo') . '%');
        }

        if ($request->filled('isbn')) {
            $query->where('ISBN', 'like', '%' . $request->query('isbn') . '%');
        }

        if ($request->filled('status')) {
            $status = filter_var(
                $request->query('status'),
                FILTER_VALIDATE_BOOLEAN,
                FILTER_NULL_ON_FAILURE
            );

            if ($status === true) {
                $query->where('Copias_disponibles', '>', 0);
            } elseif ($status === false) {
                $query->where('Copias_disponibles', '<=', 0);
            }
        }

        $books = $query->get();

        return BookResource::collection($books);
    }
}

