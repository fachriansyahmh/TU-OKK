<x-volt-app :title="__('laravolt::action.edit') . ' Disposisi Kepada'">
    <x-volt-backlink url="{{ route('modules::disposisi-kepada.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Disposisi Kepada">
        {!! form()->bind($disposisiKepada)->put(route('modules::disposisi-kepada.update', $disposisiKepada->getRouteKey()))->horizontal()->multipart() !!}
            @include('disposisi-kepada::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
