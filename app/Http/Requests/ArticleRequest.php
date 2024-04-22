<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /* 
            In here we change to true because  the authorizations 
            we go to mange in another file and the rules validations will go in here. 
        */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // We put the slug and image in here.
        $slug = request()->isMethod('put') ? 'required|unique:articles,slug,'.$this->id : 'required|unique:articles';
        $image = request()->isMethod('put') ? 'nullable|mimes:jpeg,jpg,png,gif,svg|max:8000' : 'required|image';
        return [
            // Rules of validation
            'title' => 'required:min:5|max:255',
            'slug' => $slug,
            'introduction' => 'required|min:10|max:255',
            'body' => 'required',
            'image' => $image,
            'status' => 'required|boolean',
            'category_id' =>'required|integer',
        ];
    }
}
