<x-volt-app :title="'Jenis Naskah'">
    <x-slot name="actions">
        <x-volt-link-button
            :url="route('modules::jenis-surat.create')"
            icon="plus"
            :label="__('laravolt::action.add')"
        />
    </x-slot>

    {!! $table !!}
</x-volt-app>
