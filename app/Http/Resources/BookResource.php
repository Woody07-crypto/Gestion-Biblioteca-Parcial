<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'titulo'             => $this->Titulo,
            'descripcion'        => $this->Descripcion,
            'isbn'               => $this->ISBN,
            'copias_totales'     => $this->Copias,
            'copias_disponibles' => $this->Copias_disponibles,
            'estado'             => (bool) ($this->Copias_disponibles > 0),
        ];
    }
}

