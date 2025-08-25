{!! form()->text('disposisi')->label('Disposisi')->required() !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::disposisi.index'))
    ])
!!}
