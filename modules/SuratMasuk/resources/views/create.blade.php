<x-volt-app :title="__('laravolt::action.add') . ' Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::surat-masuk.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Surat Masuk">
        {!! form()->post(route('modules::surat-masuk.store'))->horizontal()->multipart() !!}
            @include('surat-masuk::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
