<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class itemRequest extends FormRequest
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
        return [
            'title' => 'required',
            'description' => 'required|max:100',
            'amount' => 'required|numeric',
            'image_url' => 'required|max:10000|mimes:png,jpg,svg,jepg,webp',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' =>'title required',
            'description.required' =>'description required',
            'amount.numeric' => 'The bid price must be numbers',
            'price.required' => 'price required',
            'description.max' => 'Display name must not be more than 100 characters',
        ];
    }
}
