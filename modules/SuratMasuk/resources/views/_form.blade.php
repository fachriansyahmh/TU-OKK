{!! form()->dropdown('status', ['Karo' => 'Karo','Kirim' => 'Kirim'])->label('Status')->required() !!}
{{-- {!! form()->dropdownDB('pengolah_id', 'select id, nama_pengolah from pengolah ', 'id', 'nama_pengolah')->label('Nama Pengolah')->required()->placeholder('--Select--') !!} --}}
{!! form()->dropdown('sifat_naskah', ['Biasa' => 'Biasa','Segera' => 'Segera', 'Rahasia' => 'Rahasia', 'Penting' => 'Penting'])->label('Sifat Naskah')->required()->placeholder('--Select--') !!}
{!! form()->dropdownDB('jenis_naskah_id', 'select id, jenis_surat from jenis_surat ', 'id', 'jenis_surat')->label('Jenis Naskah')->required()->placeholder('--Select--') !!}
{!! form()->text('nama_pengirim')->label('Nama Pengirim')->required() !!}
{!! form()->text('jabatan_pengirim')->label('Jabatan Pengirim')->required() !!}
{!! form()->text('instansi_pengirim')->label('Instansi Pengirim')->required() !!}
{!! form()->text('nomor_naskah')->label('Nomor Naskah')->required() !!}
{!! form()->date('tgl_naskah')->label('Tgl Naskah')->required() !!}
{!! form()->date('tgl_diterima')->label('Tgl Diterima')->required() !!}
{!! form()->textarea('ringkasan_isi_surat')->label('Ringkasan Isi Surat')->required() !!}
@if ($suratMasuk->lampiran)
{!! form()->uploader('lampiran')->label('Lampiran')->value($suratMasuk->lampiran) !!}

@else
{!! form()->uploader('lampiran')->label('Lampiran')->required()->value($suratMasuk->lampiran) !!}
@endif

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::surat-masuk.index'))
    ])
!!}

<script>
document.addEventListener('DOMContentLoaded', function() {
    let inputLampiran = document.querySelector('input[name="lampiran"]');

    if (inputLampiran) {
        // Ubah name
        inputLampiran.setAttribute('name', '_lampiran');

        // Set value default dari Laravel
        inputLampiran.setAttribute('value', "{{ $suratMasuk->lampiran }}");
    }
});
</script>
