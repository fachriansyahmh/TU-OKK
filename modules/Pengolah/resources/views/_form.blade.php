{!! form()->text('nama_pengolah')->label('Nama Pengolah')->required() !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::pengolah.index'))
    ])
!!}
