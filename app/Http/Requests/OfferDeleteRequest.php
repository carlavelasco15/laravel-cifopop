<?php

namespace App\Http\Requests;

use App\Models\Offer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class OfferDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('delete', Offer::find($this->offer_id));
    }

    protected function failedAuthorizaiton() {
        throw new AuthorizationException('No puedes no puedes eliminar una oferta que no es de tu anuncio.');
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
