<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TanahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'kategori' => 'required|in:polres,polsek',
            'polsek_nama' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'luas_seluruhnya' => 'required|numeric|min:0',
            'luas_tanah_bangunan' => 'required|numeric|min:0',
            'luas_tanah_sarana' => 'required|numeric|min:0',
            'status' => 'required|in:Pinjam pakai,Sertifikat',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        // Polsek nama wajib jika kategori = polsek
        if ($this->kategori === 'polsek') {
            $rules['polsek_nama'] = 'required|string|max:255';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'kategori.required' => 'Kategori harus dipilih',
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'luas_seluruhnya.required' => 'Luas tanah seluruhnya harus diisi',
            'luas_seluruhnya.numeric' => 'Luas tanah seluruhnya harus berupa angka',
            'luas_seluruhnya.min' => 'Luas tanah seluruhnya tidak boleh negatif',
            'luas_tanah_bangunan.required' => 'Luas tanah bangunan harus diisi',
            'luas_tanah_bangunan.numeric' => 'Luas tanah bangunan harus berupa angka',
            'luas_tanah_bangunan.min' => 'Luas tanah bangunan tidak boleh negatif',
            'luas_tanah_sarana.required' => 'Luas tanah sarana harus diisi',
            'luas_tanah_sarana.numeric' => 'Luas tanah sarana harus berupa angka',
            'luas_tanah_sarana.min' => 'Luas tanah sarana tidak boleh negatif',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus Pinjam pakai atau Sertifikat',
            'polsek_nama.required' => 'Nama Polsek harus dipilih',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG',
            'foto.max' => 'Ukuran foto maksimal 2MB',
        ];
    }
}