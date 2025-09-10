<x-volt-app :title="__('laravolt::action.add') . ' Log Disposisi'">
    <x-volt-backlink url="{{ route('modules::log-disposisi.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Log Disposisi">
        {!! form()->post(route('modules::log-disposisi.store'))->horizontal()->multipart() !!}
            @include('log-disposisi::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
