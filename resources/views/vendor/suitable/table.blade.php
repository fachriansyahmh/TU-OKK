<?php

$tableClass = '';
    if ($showHeader && $showFooter) {
        $tableClass = 'attached';
    } elseif ($showHeader) {
        $tableClass = 'bottom attached';
    } elseif($showFooter) {
        $tableClass = 'top attached';
    }
?>

<style>
    /* MENAMBAHKAN KODE INI UNTUK MEMBUAT HEADER TEBAL */
    .auto-width-table th {
        font-weight: 900 !important; /* Meningkatkan ketebalan font */
    }

    .auto-width-table {
        table-layout: auto;
        white-space: nowrap;
    }

    .auto-width-table td,
    .auto-width-table th {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .auto-width-table td:nth-child(2):has(img),
    .auto-width-table th:nth-child(2):has(img) {
        min-width: 60px;
        width: 1%;
        white-space: nowrap;
        max-width: 100px;
        /* ✅ Boleh kasih batas khusus kolom ini */
    }

        /* Sembunyikan tombol "Add" khusus untuk halaman log surat masuk */
    a.button[href*="/log-surat-masuk/create"] {
        display: none !important;
    }
</style>

<div class="overflow-x-auto w-full" style="overflow-x: auto">
<table class="ui {{ $tableClass }} stripped table unstackable responsive auto-width-table">
    <thead>
    <tr>
        @foreach($columns as $column)
            @if($column->header() instanceof \Laravolt\Suitable\Contracts\Header)
                {!! $column->header()->render() !!}
            @else
                {!! $column->header() !!}
            @endif
        @endforeach
    </tr>
    @if($hasSearchableColumns)
    <tr class="ui form" data-role="suitable-header-searchable">
        @foreach($columns as $column)
            @if($column->isSearchable())
                {!! $column->searchableHeader()->render() !!}
            @else
                <th></th>
            @endif
        @endforeach
    </tr>
    @endif
    </thead>
    <tbody class="collection">
    @forelse($collection as $data)
        @php
            // Logika untuk menentukan kelas CSS berdasarkan status
            $rowClass = '';
            if (isset($data->status)) {
                if ($data->status === 'Kirim') {
                    $rowClass = 'green'; // Warna hijau yang lebih jelas
                }
                // Kondisi untuk status 'Karo' dihapus, sehingga akan menggunakan warna default
            }
            // Menyimpan variabel loop dari baris data sebelum masuk ke loop kolom
            $outerLoop = $loop;
        @endphp
        <tr class="{{ $rowClass }}">
            @foreach($columns as $column)
                {{-- Menggunakan $outerLoop agar penomoran baris benar --}}
                <td {!! $column->cellAttributes($data) !!}>{!! $column->cell($data, $collection, $outerLoop) !!}</td>
            @endforeach
        </tr>
    @empty
        @include('suitable::empty')
    @endforelse
    </tbody>
</table>
</div>

<script>
    document.querySelectorAll('.auto-width-table td, .auto-width-table th').forEach(cell => {
        if (cell.scrollWidth > cell.clientWidth) {
            cell.style.whiteSpace = 'normal';
            cell.style.wordBreak = 'break-word';
        }
    });
</script>
