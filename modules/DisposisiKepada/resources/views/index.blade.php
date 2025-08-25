<x-volt-app :title="'Disposisi Kepada'">
    <x-slot name="actions">
        <x-volt-link-button
            :url="route('modules::disposisi-kepada.create')"
            icon="plus"
            :label="__('laravolt::action.add')"
        />
    </x-slot>

    {!! $table !!}
</x-volt-app>
