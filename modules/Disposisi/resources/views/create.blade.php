<x-volt-app :title="__('laravolt::action.add') . ' Disposisi'">
    <x-volt-backlink url="{{ route('modules::disposisi.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Disposisi">
        {!! form()->post(route('modules::disposisi.store'))->horizontal()->multipart() !!}
            @include('disposisi::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
