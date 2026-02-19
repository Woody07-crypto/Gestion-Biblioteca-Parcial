<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreLoanRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'book_id' => ['required', 'integer', 'exists:books,id'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $bookId = $this->input('book_id');

            if (! $bookId) {
                return;
            }

            $book = DB::table('books')->where('id', $bookId)->first();

            if (! $book) {
                return;
            }

            if ($book->Copias_disponibles <= 0) {
                $validator->errors()->add('book_id', 'No hay copias disponibles para este libro.');
            }
        });
    }
}

