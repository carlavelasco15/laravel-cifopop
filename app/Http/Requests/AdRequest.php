<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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

    protected function failedAuthorization()
    {
        throw new AuthorizationException('No puedes editar un anuncio que no es tuyo');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => 'required|max:255|min:3',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048',
            'descripcion' => 'required|min:3',
        ];
    }
}
