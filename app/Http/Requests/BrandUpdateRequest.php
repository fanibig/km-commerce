<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
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
        $brand = $this->route('id');
        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', Rule::unique('brands', 'slug')->ignore($brand)],
            'brand_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'meta_keywords' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'description' => ['nullable', 'string'],
        ];
    }
}