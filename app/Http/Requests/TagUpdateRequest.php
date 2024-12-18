<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
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
        $tad = $this->route('id');
        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', Rule::unique('tags', 'slug')->ignore($tad)],
            'description' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }
}