<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(BookRequest $request)
    {
        //** CONSULTA DE CATALOGO */
        //** Retorna: título, descripción, ISBN, copias totales, copias disponibles y estado (booleano). Filtros: búsqueda por titulo, isbn y status. Uso obligatorio de API Resources para el mapeo */
        $query = Book::query();
        if ($request->has('titulo')) {
            $query->where('titulo', 'like', '%' . $request->input('titulo') . '%');
        }
        if ($request->has('isbn')) {
            $query->where('isbn', $request->input('isbn'));
        }
        if ($request->has('estado')) {
            $query->where('estado', $request->input('estado'));
        }
        $books = $query->get();
        return response()->json([
            'message' => 'Listado de libros',
            'data' => BookResource::collection($books)
        ]);
    }

    //**  Prestar Libro*/

    public function store(Request $request)
    {
        $validated = $request->validate([
            'solicitante' => 'required|string|max:255',
            'book_id' => 'required|exists:book,id',
        ]);
    
        $book = Book::find($validated['book_id']);
        if ($book->copias_disponibles < 1) {
            return response()->json(['message' => 'No hay copias disponibles'], 422);
        }
    
        // Registrar el préstamo
        $loan = Loan::create([
            'solicitante' => $validated['solicitante'],
            'fecha_prestamo' => now(),
            'book_id' => $validated['book_id'],
        ]);
    
        // Actualizar el libro
        $book->copias_disponibles -= 1;
        if ($book->copias_disponibles == 0) {
            $book->estado = false;
        }
        $book->save();
    
        return response()->json([
            'message' => 'Préstamo registrado exitosamente',
            'data' => [
                'loan_id' => $loan->id,
                'solicitante' => $loan->solicitante,
                'fecha_prestamo' => $loan->fecha_prestamo,
                'book_id' => $loan->book_id,
            ]
        ], 201);
    }

    // ** Registro de Devolución */
    public function returnBook($loan_id)
    {
        $loan = Loan::find($loan_id);
        if (!$loan) {
            return response()->json(['message' => 'Préstamo no encontrado'], 404);
        }
    
        $book = Book::find($loan->book_id);
        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
    
        // Verificar si el libro ya fue devuelto
        if ($book->copias_disponibles >= $book->copias_totales) {
            return response()->json(['message' => 'Libro devuelto anteriormente'], 422);
        }
    
        // Registrar la devolución
        $loan->fecha_devolucion = now();
        $loan->save();
    
        // Actualizar el libro
        $book->copias_disponibles += 1;
        if ($book->copias_disponibles > 0) {
            $book->estado = true;
        }
        $book->save();
    
        return response()->json([
            'message' => 'Devolución exitosa',
            'data' => [
                'loan_id' => $loan->id,
                'solicitante' => $loan->solicitante,
                'fecha_prestamo' => $loan->fecha_prestamo,
                'fecha_devolucion' => $loan->fecha_devolucion,
                'book_id' => $loan->book_id,
            ]
        ], 200);
    }

}
