<x-volt-app :title="__('laravolt::action.edit') . ' Pengolah'">
    <x-volt-backlink url="{{ route('modules::pengolah.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Pengolah">
        {!! form()->bind($pengolah)->put(route('modules::pengolah.update', $pengolah->getRouteKey()))->horizontal()->multipart() !!}
            @include('pengolah::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
