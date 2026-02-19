<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'isbn' => 'required|string|unique:book,isbn',
            'copias_totales' => 'required|integer|min:1',
            'copias_disponibles' => 'required|integer|min:0|lte:copias_totales',
            'estado' => 'required|boolean',
        ];
    }
}
