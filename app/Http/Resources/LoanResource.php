<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    public function toArray($request): array
    {
        $esActivo = is_null($this->fecha_devolucion) && $this->estado === 'prestado';

        return [
            'id'               => $this->id,
            'estado'           => $esActivo ? 'Activo' : 'Devuelto',
            'activo'           => $esActivo,
            'fecha_prestamo'   => $this->fecha_prestamo,
            'fecha_devolucion' => $this->fecha_devolucion,
            'book'             => $this->whenLoaded('book', function () {
                return new BookResource($this->book);
            }),
        ];
    }
}

