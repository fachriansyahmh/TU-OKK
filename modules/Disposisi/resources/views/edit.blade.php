<x-volt-app :title="__('laravolt::action.edit') . ' Disposisi'">
    <x-volt-backlink url="{{ route('modules::disposisi.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Disposisi">
        {!! form()->bind($disposisi)->put(route('modules::disposisi.update', $disposisi->getRouteKey()))->horizontal()->multipart() !!}
            @include('disposisi::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
