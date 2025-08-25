<x-volt-app :title="'Detail Disposisi Kepada'">
    <x-volt-backlink url="{{ route('modules::disposisi-kepada.index') }}"/>

    <x-volt-panel title="Detil Disposisi Kepada">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $disposisiKepada->id }}</td></tr>
        <tr><td>Created At</td><td>{{ $disposisiKepada->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $disposisiKepada->updated_at }}</td></tr>
        <tr><td>Disposisi Kepada</td><td>{{ $disposisiKepada->disposisi_kepada }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
