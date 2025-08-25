<x-volt-app :title="'Detail Disposisi'">
    <x-volt-backlink url="{{ route('modules::disposisi.index') }}"/>

    <x-volt-panel title="Detil Disposisi">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $disposisi->id }}</td></tr>
        <tr><td>Created At</td><td>{{ $disposisi->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $disposisi->updated_at }}</td></tr>
        <tr><td>Disposisi</td><td>{{ $disposisi->disposisi }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
