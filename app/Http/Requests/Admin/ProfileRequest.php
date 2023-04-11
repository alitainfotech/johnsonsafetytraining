<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileRequest extends FormRequest
{
    /**
     * @author Jayesh
     * 
     * @uses Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @author Jayesh
     * 
     * @uses Get the validation rules that apply to the request.
     * 
     * @param  mixed Request $request
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            'full_name' => 'required|max:255',
        ];
    }
}
