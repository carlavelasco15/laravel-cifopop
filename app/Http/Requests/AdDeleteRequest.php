<?php

namespace App\Http\Requests;

use App\Models\Ad;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class AdDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('delete', $this->ad);
    }

    protected function failedAuthorizaiton() {
        throw new AuthorizationException('No puedes eliminar un anuncio que no es tuyo');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
