<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ZakazSertRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'summa' => 'required|max:255'
        ];
    }
}
