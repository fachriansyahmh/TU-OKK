<x-volt-app :title="'Detail Pengolah'">
    <x-volt-backlink url="{{ route('modules::pengolah.index') }}"/>

    <x-volt-panel title="Detil Pengolah">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $pengolah->id }}</td></tr>
        <tr><td>Created At</td><td>{{ $pengolah->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $pengolah->updated_at }}</td></tr>
        <tr><td>Nama Pengolah</td><td>{{ $pengolah->nama_pengolah }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
