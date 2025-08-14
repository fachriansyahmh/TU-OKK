{!! form()->text('jenis_surat')->label('Jenis Naskah')->required() !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::jenis-surat.index'))
    ])
!!}
