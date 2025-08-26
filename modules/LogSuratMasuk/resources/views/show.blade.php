<x-volt-app :title="'Detail Log Surat Masuk'">
    <x-volt-backlink url="{{ route('modules::log-surat-masuk.index') }}"/>

    <x-volt-panel title="Detil Log Surat Masuk">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $logSuratMasuk->id }}</td></tr>
        <tr><td>User Id</td><td>{{ $logSuratMasuk->user_id }}</td></tr>
        <tr><td>Surat Masuk Id</td><td>{{ $logSuratMasuk->surat_masuk_id }}</td></tr>
        <tr><td>Action</td><td>{{ $logSuratMasuk->action }}</td></tr>
        <tr><td>Description</td><td>{{ $logSuratMasuk->description }}</td></tr>
        <tr><td>Created At</td><td>{{ $logSuratMasuk->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $logSuratMasuk->updated_at }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
