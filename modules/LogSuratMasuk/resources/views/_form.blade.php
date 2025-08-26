{!! form()->text('user_id')->label('User Id') !!}
{!! form()->text('surat_masuk_id')->label('Surat Masuk Id')->required() !!}
{!! form()->text('action')->label('Action')->required() !!}
{!! form()->textarea('description')->label('Description')->required() !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::log-surat-masuk.index'))
    ])
!!}
