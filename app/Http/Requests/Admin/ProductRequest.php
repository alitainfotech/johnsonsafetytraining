<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
                return [
                    'name' => 'required|unique:products,name',
                    'category_id' => 'required|min:1|exists:categories,id',
                    'description' => 'nullable',
                    'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                    'files' => 'required|array|min:1',
                    'files.*' => 'required|mimes:jpeg,jpg,png,gif',
                    'materials' => 'array|min:1',
                    'materials.*' => 'mimes:csv,txt,xlx,xls,pdf,pptx,xlsx,doc,docx,jpeg,jpg,png',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|unique:products,name,' . $this->product->id,
                    'category_id' => 'required|exists:categories,id',
                    'description' => 'nullable',
                    'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                    'files' => 'nullable',
                    'files.*' => 'required|mimes:jpeg,jpg,png,gif',
                    'materials' => 'array|min:1',
                    'materials.*' => 'mimes:csv,txt,xlx,xls,pdf,pptx,xlsx,doc,docx,jpeg,jpg,png',
                ];
                break;
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'price.regex' => 'The price field is invalid.'
        ];
    }
}
