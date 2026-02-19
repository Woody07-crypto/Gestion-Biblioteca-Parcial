<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'Titulo',
        'Descripcion',
        'ISBN',
        'Copias',
        'Copias_disponibles',
        'Estado',
    ];

    /**
     * A book can have many loans.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

