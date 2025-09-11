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
    /* ... (CSS Anda yang lain tetap sama) ... */
    .auto-width-table th {
        font-weight: 900 !important;
    }
    .ui.table tr.green td {
        color: black !important;
    }
    .auto-width-table .sticky-col {
        position: -webkit-sticky;
        position: sticky;
        z-index: 2;
        background: white;
    }
    .auto-width-table .first-col { left: 0; }
    .auto-width-table .second-col { left: 50px; }

    /* CSS BARU UNTUK WADAH TABEL YANG BISA DIGULIR */
    .table-scroll-wrapper {
        max-height: 70vh; /* Batasi tinggi tabel, misal 70% dari tinggi layar */
        overflow-y: auto; /* Tambahkan scrollbar vertikal HANYA untuk area tabel */
        position: relative;
    }

    /* CSS BARU UNTUK STICKY HEADER DI DALAM WADAH GULIR */
    .auto-width-table thead th {
        position: -webkit-sticky;
        position: sticky;
        top: 0; /* Menempel di paling atas DARI WADAH GULIRNYA */
        z-index: 3;
        background: #f9fafb !important;
    }

    /* ========================================================= */
    /* PERBAIKAN: Lebar kolom disesuaikan agar lebih ringkas      */
    /* ========================================================= */
    .auto-width-table th:nth-child(1), .auto-width-table td:nth-child(1) { min-width: 50px; } /* No */
    .auto-width-table th:nth-child(2), .auto-width-table td:nth-child(2) { min-width: 120px; } /* Penomoran */
    .auto-width-table th:nth-child(3), .auto-width-table td:nth-child(3) { min-width: 100px; } /* Status */
    .auto-width-table th:nth-child(4), .auto-width-table td:nth-child(4) { min-width: 180px; } /* Pengolah */
    .auto-width-table th:nth-child(5), .auto-width-table td:nth-child(5) { min-width: 140px; } /* Sifat Naskah */
    .auto-width-table th:nth-child(6), .auto-width-table td:nth-child(6) { min-width: 140px; } /* Jenis Naskah */
    .auto-width-table th:nth-child(7), .auto-width-table td:nth-child(7) { min-width: 200px; } /* Disposisi Kepada */
    .auto-width-table th:nth-child(8), .auto-width-table td:nth-child(8) { min-width: 160px; } /* Disposisi */
    .auto-width-table th:nth-child(9), .auto-width-table td:nth-child(9) { min-width: 220px; } /* Isi Disposisi */
    .auto-width-table th:nth-child(10), .auto-width-table td:nth-child(10) { min-width: 220px; } /* Nama Pengirim */
    .auto-width-table th:nth-child(11), .auto-width-table td:nth-child(11) { min-width: 180px; } /* Jabatan Pengirim */
    .auto-width-table th:nth-child(12), .auto-width-table td:nth-child(12) { min-width: 250px; } /* Asal Pengirim */
    .auto-width-table th:nth-child(13), .auto-width-table td:nth-child(13) { min-width: 250px; } /* Nomor Naskah */
    .auto-width-table th:nth-child(14), .auto-width-table td:nth-child(14) { min-width: 150px; } /* Tanggal Naskah */
    .auto-width-table th:nth-child(15), .auto-width-table td:nth-child(15) { min-width: 150px; } /* Tanggal Diterima */
    .auto-width-table th:nth-child(16), .auto-width-table td:nth-child(16) { min-width: 300px; white-space: normal !important; } /* Isi Disposisi Sekjen */
    .auto-width-table th:nth-child(17), .auto-width-table td:nth-child(17) { min-width: 350px; white-space: normal !important; } /* Ringkasan Isi Surat */
    .auto-width-table th:nth-child(18), .auto-width-table td:nth-child(18) { min-width: 100px; } /* Lampiran */
    .auto-width-table th:nth-child(19), .auto-width-table td:nth-child(19) { min-width: 140px; } /* Disposisi (Tombol) */
    .auto-width-table th:nth-child(20), .auto-width-table td:nth-child(20) { min-width: 150px; } /* Aksi */
    /* ========================================================= */

</style>

{{-- PERBAIKAN FINAL: Menambahkan div pembungkus untuk area gulir --}}
<div class="table-scroll-wrapper">
    <div class="overflow-x-auto w-full">
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
                    $rowClass = '';
                    if (($data->status ?? '') === 'Kirim' || !empty($data->disposisi_kepada) || !empty($data->disposisi_id) || !empty($data->isi_disposisi)) {
                        $rowClass = 'green';
                    }
                    $outerLoop = $loop;
                @endphp
                <tr class="{{ $rowClass }}">
                    @foreach($columns as $column)
                        <td {!! $column->cellAttributes($data) !!}>{!! $column->cell($data, $collection, $outerLoop) !!}</td>
                    @endforeach
                </tr>
            @empty
                @include('suitable::empty')
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Skrip digabungkan menjadi satu untuk kebersihan --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Skrip untuk text overflow
        document.querySelectorAll('.auto-width-table td, .auto-width-table th').forEach(cell => {
            if (cell.scrollWidth > cell.clientWidth) {
                cell.style.whiteSpace = 'normal';
                cell.style.wordBreak = 'break-word';
            }
        });

        // Skrip untuk fitur zoom
        const zoomInBtn = document.getElementById('zoom-in-btn');
        const zoomOutBtn = document.getElementById('zoom-out-btn');
        const zoomResetBtn = document.getElementById('zoom-reset-btn');
        const table = document.querySelector('.auto-width-table');
        const storageKey = 'tableZoomLevel';

        const defaultZoom = 1;
        const step = 0.1;
        let currentZoom = parseFloat(localStorage.getItem(storageKey)) || defaultZoom;

        function applyZoom(zoomLevel) {
            table.style.fontSize = zoomLevel + 'rem';
            localStorage.setItem(storageKey, zoomLevel);
        }

        applyZoom(currentZoom);

        zoomInBtn.addEventListener('click', function () {
            currentZoom += step;
            applyZoom(currentZoom);
        });

        zoomOutBtn.addEventListener('click', function () {
            if (currentZoom > 0.5 + step) {
                currentZoom -= step;
                applyZoom(currentZoom);
            }
        });

        zoomResetBtn.addEventListener('click', function () {
            currentZoom = defaultZoom;
            applyZoom(currentZoom);
            localStorage.removeItem(storageKey);
        });
    });
</script>

