<?php

namespace Modules\SuratMasuk\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // Aturan yang sudah ada dibuat 'sometimes' agar tidak wajib diisi saat update disposisi
            'status' => ['sometimes', 'required'],
            'pengolah_id' => ['nullable'],
            'sifat_naskah' => ['sometimes', 'required'],
            'jenis_naskah_id' => ['nullable'],
            'nama_pengirim' => ['sometimes', 'required'],
            'jabatan_pengirim' => ['sometimes', 'required'],
            'instansi_pengirim' => ['sometimes', 'required'],
            'nomor_naskah' => ['sometimes', 'required'],
            'tgl_naskah' => ['sometimes', 'required'],
            'tgl_diterima' => ['sometimes', 'required'],
            'ringkasan_isi_surat' => ['sometimes', 'required'],
            '_lampiran' => ['sometimes', 'required'],

            // Aturan validasi baru untuk form disposisi
            'disposisi_kepada' => ['nullable', 'string', 'max:255'],
            'disposisi_id' => ['nullable', 'integer'],
            'isi_disposisi' => ['nullable', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
