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
            'status' => ['required'],
            'pengolah_id' => [''],
            'sifat_naskah' => ['required'],
            'jenis_naskah_id' => [''],
            'nama_pengirim' => ['required'],
            'jabatan_pengirim' => ['required'],
            'instansi_pengirim' => ['required'],
            'nomor_naskah' => ['required'],
            'tgl_naskah' => ['required'],
            'tgl_diterima' => ['required'],
            'ringkasan_isi_surat' => ['required'],
            '_lampiran' => ['required'],
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
