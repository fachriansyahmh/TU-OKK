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
        @php($outerLoop = $loop)
        @if($row)
            @include($row)
        @else
            <tr>
                @foreach($columns as $column)
                    <td {!! $column->cellAttributes($data) !!}>{!! $column->cell($data, $collection, $outerLoop) !!}</td>
                @endforeach
            </tr>
        @endif
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