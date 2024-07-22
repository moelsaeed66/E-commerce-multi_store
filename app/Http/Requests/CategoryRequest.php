<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Illuminate\Support\Facades\Gate::allows('categories.update');
//        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($id=0): array
    {
        $id=$this->route('category');
        return Category::rules($id);
    }
    public function messages()
    {
        return [
            'required'=>'this :attribute is required',
            'unique'=>'this :attribute already exist'
        ];
    }
}
