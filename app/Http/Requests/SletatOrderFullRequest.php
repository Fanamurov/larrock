<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SletatOrderFullRequest extends Request
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
			'fio' => 'required|max:255',
			'address' => 'required',
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'passport' => 'required|max:255',
			'passportDate' => 'required',
			'oferta' => 'required'
		];
    }
}
