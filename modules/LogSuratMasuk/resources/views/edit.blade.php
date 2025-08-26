<x-volt-app :title="__('laravolt::action.edit') . ' Log Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::log-surat-masuk.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Log Surat Masuk">
        {!! form()->bind($logSuratMasuk)->put(route('modules::log-surat-masuk.update', $logSuratMasuk->getRouteKey()))->horizontal()->multipart() !!}
            @include('log-surat-masuk::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
