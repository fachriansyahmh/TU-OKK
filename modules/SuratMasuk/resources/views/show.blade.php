<x-volt-app :title="'Detail Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::surat-masuk.index') }}"/>

    <x-volt-panel title="Detil Surat Masuk">
        <table class="ui table definition">
            <tr><td class="two wide">ID</td><td>{{ $suratMasuk->id }}</td></tr>
            <tr><td>Penomoran</td><td>{{ str_pad($suratMasuk->nomor_urut, 4, '0', STR_PAD_LEFT) }}</td></tr>
            <tr><td>Status</td><td>{{ $suratMasuk->status }}</td></tr>
            <tr><td>Pengolah</td><td>{{ $suratMasuk->pengolah?->name }}</td></tr>
            <tr><td>Sifat Naskah</td><td>{{ $suratMasuk->sifat_naskah }}</td></tr>
            <tr><td>Jenis Naskah</td><td>{{ $suratMasuk->jenis_surat?->jenis_surat }}</td></tr>
            <tr><td>Nama Pengirim</td><td>{{ $suratMasuk->nama_pengirim }}</td></tr>
            <tr><td>Jabatan Pengirim</td><td>{{ $suratMasuk->jabatan_pengirim }}</td></tr>
            <tr><td>Asal Pengirim</td><td>{{ $suratMasuk->asal_pengirim }}</td></tr>
            <tr><td>Nomor Naskah</td><td>{{ $suratMasuk->nomor_naskah }}</td></tr>
            <tr><td>Tanggal Naskah</td><td>{{ $suratMasuk->tgl_naskah }}</td></tr>
            <tr><td>Tanggal Diterima</td><td>{{ $suratMasuk->tgl_diterima }}</td></tr>
            <tr><td>Isi Disposisi Sekjen/Deputi</td><td>{{ $suratMasuk->isi_disposisi_sekjen_deputi }}</td></tr>
            <tr><td>Ringkasan Isi Surat</td><td>{{ $suratMasuk->ringkasan_isi_surat }}</td></tr>
            <tr><td>Dibuat Pada</td><td>{{ $suratMasuk->created_at?->isoFormat('D MMMM YYYY, HH:mm') }}</td></tr>
            <tr><td>Diperbarui Pada</td><td>{{ $suratMasuk->updated_at?->isoFormat('D MMMM YYYY, HH:mm') }}</td></tr>
            <tr>
                <td>Lampiran</td>
                <td>
                    @if($suratMasuk->lampiran)
                        <a href="{{ $suratMasuk->lampiran }}" target="_blank" class="ui icon button basic mini">
                            <i class="file alternate icon"></i> Lihat Lampiran
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr><td colspan="2" class="ui dividing header"><h4>Informasi Disposisi</h4></td></tr>
            <tr><td>Disposisi Kepada</td><td>{{ $suratMasuk->disposisi_kepada }}</td></tr>
            <tr><td>Arahan Disposisi</td><td>{{ $suratMasuk->disposisi?->disposisi }}</td></tr>
            <tr><td>Isi Disposisi</td><td>{{ $suratMasuk->isi_disposisi }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>