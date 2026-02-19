<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'user_id',
        'book_id',
        'fecha_prestamo',
        'fecha_devolucion',
        'estado',
    ];
    
    /**
     * The loan belongs to a book.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * The loan belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

