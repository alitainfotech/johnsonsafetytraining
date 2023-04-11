<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
        switch ($request->method) {
            case 'POST':
                return ['name' => 'required|max:255|unique:categories,name'];
                break;
            case 'PUT':
                return ['name' => 'required|max:255|unique:categories,name,' . $this->category->id];
                break;
            default:
                break;
        }
    }
}
