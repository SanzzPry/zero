<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuperAdminRequest extends FormRequest
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
            'img_profile'     => 'nullable|image|max:2048',
            'nama_lengkap' => 'sometimes|string|max:255',

            'province_id'   => 'sometimes|integer',
            'city_id'       => 'sometimes|integer',
            'district_id'   => 'sometimes|integer',

            'provinsi' => 'sometimes|string|max:100',
            'kota'     => 'sometimes|string|max:100',
            'kecamatan' => 'sometimes|string|max:100',

            'desa'       => 'nullable|string|max:100',
            'detail_alamat' => 'nullable|string|max:255',
            'kode_pos'   => 'nullable|string|max:10',
        ];
    }
}
