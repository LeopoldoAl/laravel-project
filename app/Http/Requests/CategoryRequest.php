<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
        $slug = request()->isMethod('put') ? 'required|unique:categories,slug,'.$this->id : 'required|unique:categories';
        $image = request()->isMethod('put') ? 'nullable|image' : 'required|image';
        return [
            // Rules of validation
            'name' => 'required|max:40',
            'slug' => $slug,
            'image' => $image,
            'is_featured' => 'required|boolean',
            'status' => 'required|boolean',
        ];
    }
}
