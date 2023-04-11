<?php

namespace App\Http\Requests\Admin;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'c_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|different:c_password',
            're_password' => 'same:new_password',
        ];
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Set custom message
     *
     * @return void
     */
    public function messages()
    {
        return [
            'c_password.required' => 'The current password field is required.',
            'new_password.required' => 'The new password field is required.',
            're_password.same' => 'The re-enter password should be same as new password.',
        ];
    }
}
