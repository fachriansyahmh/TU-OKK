<x-volt-app :title="'Detail Log Disposisi'">
    <x-volt-backlink url="{{ route('modules::log-disposisi.index') }}"/>

    <x-volt-panel title="Detil Log Disposisi">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $logDisposisi->id }}</td></tr>
        <tr><td>User Id</td><td>{{ $logDisposisi->user_id }}</td></tr>
        <tr><td>Surat Masuk Id</td><td>{{ $logDisposisi->surat_masuk_id }}</td></tr>
        <tr><td>Action</td><td>{{ $logDisposisi->action }}</td></tr>
        <tr><td>Description</td><td>{{ $logDisposisi->description }}</td></tr>
        <tr><td>Created At</td><td>{{ $logDisposisi->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $logDisposisi->updated_at }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
