<x-volt-app :title="__('laravolt::action.add') . ' Pengolah'">
    <x-volt-backlink url="{{ route('modules::pengolah.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Pengolah">
        {!! form()->post(route('modules::pengolah.store'))->horizontal()->multipart() !!}
            @include('pengolah::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
