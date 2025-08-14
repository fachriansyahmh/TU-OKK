<x-volt-app :title="'Pengolah'">
    <x-slot name="actions">
        <x-volt-link-button
            :url="route('modules::pengolah.create')"
            icon="plus"
            :label="__('laravolt::action.add')"
        />
    </x-slot>

    {!! $table !!}
</x-volt-app>
