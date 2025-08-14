<x-volt-app :title="__('laravolt::action.edit') . ' Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::surat-masuk.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Surat Masuk">
        {!! form()->bind($suratMasuk)->put(route('modules::surat-masuk.update', $suratMasuk->getRouteKey()))->horizontal()->multipart() !!}
            @include('surat-masuk::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
