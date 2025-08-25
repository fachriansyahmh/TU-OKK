<x-volt-app :title="'Detail Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::surat-masuk.index') }}"/>

    <x-volt-panel title="Detil Surat Masuk">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $suratMasuk->id }}</td></tr>
        <tr><td>Created At</td><td>{{ $suratMasuk->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $suratMasuk->updated_at }}</td></tr>
        <tr><td>Status</td><td>{{ $suratMasuk->status }}</td></tr>
        <tr><td>Pengolah Id</td><td>{{ $suratMasuk->pengolah_id }}</td></tr>
        <tr><td>Sifat Naskah</td><td>{{ $suratMasuk->sifat_naskah }}</td></tr>
        <tr><td>Jenis Naskah Id</td><td>{{ $suratMasuk->jenis_naskah_id }}</td></tr>
        <tr><td>Nama Pengirim</td><td>{{ $suratMasuk->nama_pengirim }}</td></tr>
        <tr><td>Jabatan Pengirim</td><td>{{ $suratMasuk->jabatan_pengirim }}</td></tr>
        <tr><td>Instansi Pengirim</td><td>{{ $suratMasuk->instansi_pengirim }}</td></tr>
        <tr><td>Nomor Naskah</td><td>{{ $suratMasuk->nomor_naskah }}</td></tr>
        <tr><td>Tgl Naskah</td><td>{{ $suratMasuk->tgl_naskah }}</td></tr>
        <tr><td>Tgl Diterima</td><td>{{ $suratMasuk->tgl_diterima }}</td></tr>
        <tr><td>Ringkasan Isi Surat</td><td>{{ $suratMasuk->ringkasan_isi_surat }}</td></tr>
        {{-- <tr><td>Lampiran</td><td>{{ $suratMasuk->lampiran }}</td></tr> --}}
        </table>
    </x-volt-panel>
</x-volt-app>
