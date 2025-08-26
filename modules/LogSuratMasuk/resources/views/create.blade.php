<x-volt-app :title="__('laravolt::action.add') . ' Log Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::log-surat-masuk.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Log Surat Masuk">
        {!! form()->post(route('modules::log-surat-masuk.store'))->horizontal()->multipart() !!}
            @include('log-surat-masuk::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
