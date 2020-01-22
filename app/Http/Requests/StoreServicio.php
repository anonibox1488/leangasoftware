<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicio extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'servicio' => 'required',
            'description' => 'required',
            'archivo' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'servicio.required' => 'Debe ingresar el nombre',
            'descripcion.required' => 'Debe escribir una descripcion',
            'archivo.image' => 'El archivo de ser una imagen jpeg, png o jpg',
        ];
    }
}
