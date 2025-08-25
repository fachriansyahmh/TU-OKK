{{-- Mengubah dropdown menjadi input teks biasa --}}
{!! form()->text('disposisi_kepada')->label('Disposisi Kepada') !!}

{{-- Dropdown ini akan mengambil data dari tabel `disposisi` --}}
{!! form()->dropdownDB('disposisi_id', 'select id, disposisi from disposisi', 'id', 'disposisi')->label('Disposisi')->placeholder('--Pilih--') !!}

{!! form()->textarea('isi_disposisi')->label('Isi Disposisi') !!}

{!!
    form()->action([
        form()->submit('Simpan Disposisi'),
        form()->link('Batal', route('modules::surat-masuk.index'))
    ])
!!}
