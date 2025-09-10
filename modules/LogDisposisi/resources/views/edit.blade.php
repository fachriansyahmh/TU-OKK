<x-volt-app :title="__('laravolt::action.edit') . ' Log Disposisi'">
    <x-volt-backlink url="{{ route('modules::log-disposisi.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Log Disposisi">
        {!! form()->bind($logDisposisi)->put(route('modules::log-disposisi.update', $logDisposisi->getRouteKey()))->horizontal()->multipart() !!}
            @include('log-disposisi::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
