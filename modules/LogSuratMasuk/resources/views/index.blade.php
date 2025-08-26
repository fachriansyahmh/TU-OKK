<x-volt-app :title="'Log Surat Masuk'">
    <x-slot name="actions">
        <x-volt-link-button
            :url="route('modules::log-surat-masuk.create')"
            icon="plus"
            :label="__('laravolt::action.add')"
        />
    </x-slot>

    {!! $table !!}
</x-volt-app>
