{!! form()->textarea('disposisi_kepada')->label('Disposisi Kepada')->required() !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::disposisi-kepada.index'))
    ])
!!}
