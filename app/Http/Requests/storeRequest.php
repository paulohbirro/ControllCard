<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'tipo' => 'in:1.5,5.0',
            'nome' => 'required',
            'valor' => 'required|numeric',
//            'parcelas' => 'required_with:tipo:in:5.0',
        ];
    }
}
