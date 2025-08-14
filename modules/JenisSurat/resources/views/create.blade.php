<x-volt-app :title="__('laravolt::action.add') . ' Jenis Naskah'">
    <x-volt-backlink url="{{ route('modules::jenis-surat.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Jenis Naskah">
        {!! form()->post(route('modules::jenis-surat.store'))->horizontal()->multipart() !!}
            @include('jenis-surat::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
