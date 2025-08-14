<x-volt-app :title="__('laravolt::action.edit') . ' Jenis Naskah'">
    <x-volt-backlink url="{{ route('modules::jenis-surat.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Jenis Naskah">
        {!! form()->bind($jenisSurat)->put(route('modules::jenis-surat.update', $jenisSurat->getRouteKey()))->horizontal()->multipart() !!}
            @include('jenis-surat::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
