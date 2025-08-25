<x-volt-app :title="__('laravolt::action.add') . ' Disposisi Kepada'">
    <x-volt-backlink url="{{ route('modules::disposisi-kepada.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Disposisi Kepada">
        {!! form()->post(route('modules::disposisi-kepada.store'))->horizontal()->multipart() !!}
            @include('disposisi-kepada::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
