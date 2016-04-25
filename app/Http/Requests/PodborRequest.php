<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PodborRequest extends Request
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
			'name' => 'required|max:255',
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'country' => 'required|max:255',
			'date' => 'required|max:255',
			'time' => 'required|max:255'
        ];
    }
}
