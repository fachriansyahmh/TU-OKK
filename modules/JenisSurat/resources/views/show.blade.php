<x-volt-app :title="'Detail Jenis Naskah'">
    <x-volt-backlink url="{{ route('modules::jenis-surat.index') }}"/>

    <x-volt-panel title="Detil Jenis Naskah">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $jenisSurat->id }}</td></tr>
        <tr><td>Created At</td><td>{{ $jenisSurat->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $jenisSurat->updated_at }}</td></tr>
        <tr><td>Jenis Naskah</td><td>{{ $jenisSurat->jenis_surat }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
