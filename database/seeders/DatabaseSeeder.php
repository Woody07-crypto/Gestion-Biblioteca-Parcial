<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed example user
        User::factory()->create();

        
        $books = array_merge(
            $this->getInitialBooks(),
            $this->generateMoreBooks(90)
        );

        DB::table('books')->insert($books);
    }

    
    private function getInitialBooks(): array
    {
        $now = now();

        return [
            [
                'Titulo' => 'Don Quijote de la Mancha',
                'Descripcion' => 'Aventuras de un caballero loco',
                'ISBN' => '9788424115531',
                'Copias' => 5,
                'Copias_disponibles' => 5,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'Cien años de soledad',
                'Descripcion' => 'Historia de la familia Buendía',
                'ISBN' => '9780307350435',
                'Copias' => 3,
                'Copias_disponibles' => 3,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'Orgullo y Prejuicio',
                'Descripcion' => 'Novela de costumbres y amor',
                'ISBN' => '9788467040418',
                'Copias' => 4,
                'Copias_disponibles' => 4,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'Crimen y Castigo',
                'Descripcion' => 'Dilemas morales y justicia',
                'ISBN' => '9788420651330',
                'Copias' => 2,
                'Copias_disponibles' => 2,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'El Principito',
                'Descripcion' => 'Relato corto sobre la vida',
                'ISBN' => '9780156013987',
                'Copias' => 10,
                'Copias_disponibles' => 10,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => '1984',
                'Descripcion' => 'Distopía política y vigilancia',
                'ISBN' => '9788466332514',
                'Copias' => 6,
                'Copias_disponibles' => 6,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'La Odisea',
                'Descripcion' => 'Viaje épico de Ulises',
                'ISBN' => '9788424924515',
                'Copias' => 3,
                'Copias_disponibles' => 3,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'El Gran Gatsby',
                'Descripcion' => 'El sueño americano en los años 20',
                'ISBN' => '9788467036411',
                'Copias' => 4,
                'Copias_disponibles' => 4,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'Rayuela',
                'Descripcion' => 'Novela experimental de Cortázar',
                'ISBN' => '9788420431321',
                'Copias' => 2,
                'Copias_disponibles' => 2,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'Titulo' => 'Hamlet',
                'Descripcion' => 'Tragedia de venganza y duda',
                'ISBN' => '9788437600123',
                'Copias' => 5,
                'Copias_disponibles' => 5,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
    }

    /**
     * Generate additional random books.
     */
    private function generateMoreBooks(int $count): array
    {
        $faker = \Faker\Factory::create('es_ES');
        $books = [];

        for ($i = 0; $i < $count; $i++) {
            $copies = $faker->numberBetween(1, 10);
            $now = now();

            $books[] = [
                'Titulo' => $faker->sentence(3),
                'Descripcion' => $faker->sentence(15),
                'ISBN' => $faker->unique()->isbn13(),
                'Copias' => $copies,
                'Copias_disponibles' => $copies,
                'Estado' => 'disponible',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        return $books;
    }
}
