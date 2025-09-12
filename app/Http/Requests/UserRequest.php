<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('id') ?? auth()->id(); // ambil ID user yg lagi diupdate

        return [
            'username'  => 'sometimes|string|max:255|unique:users,username,' . $id,
            'email'     => 'sometimes|email|max:255|unique:users,email,' . $id,
            'password'  => 'nullable|string',

        ];
    }
}
