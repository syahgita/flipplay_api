<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPatch = $this->isMethod('PATCH');
        $mediaId = $this->route('medium')?->id ?? $this->route('media')?->id;

        return [
            'title' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($mediaId),
            ],
            'type' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:100'],
            'genre' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:100'],
            'release_year' => [$isPatch ? 'sometimes' : 'required', 'integer', 'min:1900', 'max:2030'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi',
            'title.unique' => 'Judul media sudah terdaftar',
            'type.required' => 'Jenis media wajib diisi',
            'genre.required' => 'Genre media wajib diisi',
            'release_year.required' => 'Tahun rilis wajib diisi',
            'release_year.integer' => 'Tahun rilis harus berupa angka',
        ];
    }
}
