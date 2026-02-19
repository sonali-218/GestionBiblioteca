<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('book')->insert([[
            'titulo' => 'Don Quijote de la Mancha',
            'descripcion' => 'Aventuras de un caballero loco',
            'isbn' => '9788424115531',
            'copias_totales' => 5,
            'copias_disponibles' => 5,
            'estado' => true,
        ],
        [
            'titulo' => 'Cien años de soledad',
            'descripcion' => 'Historia de la familia Buendía',
            'isbn' => '9780307350435',
            'copias_totales' => 3,
            'copias_disponibles' => 3,
            'estado' => true,
        ],
        [
            'titulo' => 'Orgullo y Prejuicio',
            'descripcion' => 'Novela de costumbres y amor',
            'isbn' => '9788467040418',
            'copias_totales' => 4,
            'copias_disponibles' => 4,
            'estado' => true,
        ],
        [
            'titulo' => 'Crimen y Castigo',
            'descripcion' => 'Dilemas morales y justicia',
            'isbn' => '9788420651330',
            'copias_totales' => 10,
            'copias_disponibles' => 10,
            'estado' => true,
        ],
        [
            'titulo' => 'El Principito',
            'descripcion' => 'Relato corto sobre la vida',
            'isbn' => '9780156013987',
            'copias_totales' => 2,
            'copias_disponibles' => 2,
            'estado' => true,
        ],
        [
            'titulo' => '1984',
            'descripcion' => 'Distopía política y vigilancia',
            'isbn' => '9788466332514',
            'copias_totales' => 6,
            'copias_disponibles' => 6,
            'estado' => true,
        ],
        [
            'titulo' => 'La Odisea',
            'descripcion' => 'Viaje épico de Ulises',
            'isbn' => '9788424924515',
            'copias_totales' => 3,
            'copias_disponibles' => 3,
            'estado' => true,
        ],
        [
            'titulo' => 'El Gran Gatsby',
            'descripcion' => 'El sueño americano en los años 20',
            'isbn' => '9788467036411',
            'copias_totales' => 4,
            'copias_disponibles' => 4,
            'estado' => true,
        ],
        [
            'titulo' => 'Rayuela',
            'descripcion' => 'Novela experimental de Cortázar',
            'isbn' => '9788420431321',
            'copias_totales' => 2,
            'copias_disponibles' => 2,
            'estado' => true,
        ],
        [
            'titulo' => 'Hamlet',
            'descripcion' => 'Tragedia de venganza y duda',
            'isbn' => '9788437600123',
            'copias_totales' => 5,
            'copias_disponibles' => 5,
            'estado' => true,
        ]],
        );

        Book::factory()->count(90)->create();
    }
}
