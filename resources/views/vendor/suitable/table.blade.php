{{-- Tombol untuk Fitur Zoom dengan ikon baru --}}
<div class="ui mini basic buttons" style="margin-bottom: 1rem;">
    <button id="zoom-out-btn" class="ui icon button" data-tooltip="Perkecil Tampilan">
        <i class="search minus icon"></i>
    </button>
    <button id="zoom-reset-btn" class="ui icon button" data-tooltip="Zoom Default">
        <i class="search icon"></i>
    </button>
    <button id="zoom-in-btn" class="ui icon button" data-tooltip="Perbesar Tampilan">
        <i class="search plus icon"></i>
    </button>
</div>

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
    /* MEMBUAT HEADER TEBAL */
    .auto-width-table th {
        font-weight: 900 !important;
    }

    /* MEMBUAT FONT DI BARIS BERWARNA MENJADI HITAM */
    .ui.table tr.green td {
        color: black !important;
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

    /* CSS BARU UNTUK MEMBUAT KOLOM "BEKU" */
    .auto-width-table .sticky-col {
        position: -webkit-sticky; /* Untuk Safari */
        position: sticky;
        z-index: 2; /* Pastikan kolom ini di atas kolom lain */
        background: white; /* Beri warna latar agar tidak transparan */
    }

    .auto-width-table .first-col {
        left: 0; /* Kolom pertama menempel di paling kiri */
    }

    .auto-width-table .second-col {
        left: 50px; /* Kolom kedua menempel setelah kolom pertama. Angka ini mungkin perlu disesuaikan dengan lebar kolom "No" Anda. */
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
            // LOGIKA GABUNGAN: Baris akan berwarna hijau jika statusnya 'KIRIM' ATAU jika salah satu kolom disposisi sudah terisi
            $rowClass = '';
            if (
                ($data->status ?? '') === 'Kirim' ||
                !empty($data->disposisi_kepada) ||
                !empty($data->disposisi_id) ||
                !empty($data->isi_disposisi)
            ) {
                $rowClass = 'green';
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const zoomInBtn = document.getElementById('zoom-in-btn');
        const zoomOutBtn = document.getElementById('zoom-out-btn');
        const zoomResetBtn = document.getElementById('zoom-reset-btn');
        const table = document.querySelector('.auto-width-table');
        const storageKey = 'tableZoomLevel'; // Kunci untuk localStorage

        // Ukuran default dan langkah perubahan
        const defaultZoom = 1;
        const step = 0.1;

        // Ambil zoom dari localStorage atau gunakan default
        let currentZoom = parseFloat(localStorage.getItem(storageKey)) || defaultZoom;

        // Fungsi untuk menerapkan dan menyimpan zoom
        function applyZoom(zoomLevel) {
            table.style.fontSize = zoomLevel + 'rem';
            localStorage.setItem(storageKey, zoomLevel);
        }

        // Terapkan zoom saat halaman dimuat
        applyZoom(currentZoom);

        zoomInBtn.addEventListener('click', function () {
            currentZoom += step;
            applyZoom(currentZoom);
        });

        zoomOutBtn.addEventListener('click', function () {
            // Batasi agar tidak terlalu kecil
            if (currentZoom > 0.5 + step) { // Buffer kecil untuk menghindari masalah floating point
                currentZoom -= step;
                applyZoom(currentZoom);
            }
        });

        // Event listener untuk tombol reset
        zoomResetBtn.addEventListener('click', function () {
            currentZoom = defaultZoom;
            table.style.fontSize = defaultZoom + 'rem';
            localStorage.removeItem(storageKey);
        });
    });
</script>

