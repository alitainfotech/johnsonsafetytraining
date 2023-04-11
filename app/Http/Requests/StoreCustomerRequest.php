<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'date_of_birth' => 'required',
            'town_of_birth' => 'required',
            'country_of_birth' => 'required',
            'custaddress' => 'required',
            'custzipcode' => 'required',
            'custcity' => 'required',
            'state' => 'required',
        ];
    }
}