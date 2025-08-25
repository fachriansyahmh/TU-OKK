<x-volt-app :title="'Disposisi Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::surat-masuk.index') }}"></x-volt-backlink>

    <x-volt-panel title="Disposisi Surat Masuk">
        {{-- Form ini akan mengirim data ke method update di SuratMasukController --}}
        {!! form()->bind($suratMasuk)->put(route('modules::surat-masuk.update', $suratMasuk->getRouteKey()))->horizontal() !!}
        
        {{-- Menampilkan detail surat yang tidak bisa diubah dengan gaya Laravolt --}}
        {!! form()->text('nomor_naskah')->label('Nomor Naskah')->readonly() !!}
        {!! form()->text('nama_pengirim')->label('Nama Pengirim')->readonly() !!}
        {!! form()->textarea('ringkasan_isi_surat')->label('Ringkasan Isi Surat')->readonly() !!}
        
        <hr>

        {{-- Memuat field form disposisi dari file terpisah --}}
        @include('surat-masuk::_form_disposisi')
        
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
