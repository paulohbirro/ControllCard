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
            'tipo' => 'required',
            'datav1' => 'required',
           // 'nome' => 'required',
            'valor' => "required",
            'parcelas' => 'required_if:tipo,5',

//            'parcelas' => 'required_with:tipo:in:5.0',
        ];
    }
}
