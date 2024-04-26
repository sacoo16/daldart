<?php

namespace App\Http\Requests\Pictures;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePictureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'max:255',
                'required',
                'unique:picture,name,' . request()->route('picture')->id,
            ],
        ];
    }
}
