{!! form()->dropdown('status', ['Karo' => 'Karo','Kirim' => 'Kirim'])->label('Status')->required() !!}
{{-- Kolom pengolah diisi otomatis oleh sistem --}}
{!! form()->dropdown('sifat_naskah', ['Biasa' => 'Biasa','Segera' => 'Segera', 'Rahasia' => 'Rahasia', 'Penting' => 'Penting'])->label('Sifat Naskah')->required()->placeholder('--Select--') !!}
{!! form()->dropdownDB('jenis_naskah_id', 'select id, jenis_surat from jenis_surat ', 'id', 'jenis_surat')->label('Jenis Naskah')->required()->placeholder('--Select--') !!}
{!! form()->text('nama_pengirim')->label('Nama Pengirim')->required() !!}
{!! form()->text('jabatan_pengirim')->label('Jabatan Pengirim')->required() !!}
{!! form()->text('asal_pengirim')->label('Asal Pengirim')->required() !!}
{!! form()->text('nomor_naskah')->label('Nomor Naskah')->required() !!}
{!! form()->date('tgl_naskah')->label('Tgl Naskah')->required() !!}
{!! form()->date('tgl_diterima')->label('Tgl Diterima')->required() !!}
{!! form()->textarea('isi_disposisi_sekjen_deputi')->label('Isi Disposisi Sekjen/Deputi Administrasi')->required() !!}
{!! form()->textarea('ringkasan_isi_surat')->label('Ringkasan Isi Surat')->required() !!}

{{-- ================================================ --}}
{{-- BAGIAN LAMPIRAN DENGAN PERBAIKAN FINAL --}}
{{-- ================================================ --}}

@php
    $lampiranType = old('lampiran_type', $suratMasuk->exists ? ((strpos((string) $suratMasuk->lampiran, 'storage') !== false) ? 'upload' : 'link') : 'link');
    $isLink = $lampiranType === 'link';
@endphp

{{-- KODE BARU: Struktur HTML manual yang meniru Laravolt agar sejajar --}}
<div class="field required">
    <label>Tipe Lampiran</label>
    <div class="ui basic segment" style="padding: .5em 0 0 0; margin: 0;">
        <div class="ui radio checkbox" style="margin-right: 1.5rem;">
            <input type="radio" name="lampiran_type" value="link" id="lampiran_link_radio" {{ $isLink ? 'checked' : '' }}>
            <label for="lampiran_link_radio">Input Link</label>
        </div>
        <div class="ui radio checkbox">
            <input type="radio" name="lampiran_type" value="upload" id="lampiran_upload" {{ !$isLink ? 'checked' : '' }}>
            <label for="lampiran_upload">Upload File</label>
        </div>
    </div>
</div>


{{-- Input Uploader File --}}
<div id="uploader-container" style="@if($isLink) display: none; @endif">
    {!! form()->uploader('lampiran')->label('Lampiran')->required(false)->value($isLink ? null : $suratMasuk->lampiran) !!}
</div>

{{-- Input Link --}}
<div id="link-container" style="@if(!$isLink) display: none; @endif">
    {!! form()->text('lampiran_link')->label('Link Lampiran')->value(old('lampiran_link', $isLink ? $suratMasuk->lampiran : null)) !!}
</div>

{{-- ================================================ --}}
{{-- SELESAI BAGIAN LAMPIRAN --}}
{{-- ================================================ --}}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::surat-masuk.index'))
    ])
!!}

<script>
    // Menggunakan jQuery yang merupakan standar di Laravolt untuk memastikan kompatibilitas
    $(document).ready(function() {
        // Inisialisasi komponen radio button Semantic UI agar berfungsi dengan benar
        $('.ui.radio.checkbox').checkbox();

        const uploaderContainer = $('#uploader-container');
        const linkContainer = $('#link-container');
        const linkInput = $('input[name="lampiran_link"]');

        function toggleLampiranInput(type) {
            if (type === 'upload') {
                uploaderContainer.show();
                linkContainer.hide();
                linkInput.val('');
            } else {
                uploaderContainer.hide();
                linkContainer.show();
            }
        }

        $('input[name="lampiran_type"]').on('change', function() {
            toggleLampiranInput($(this).val());
        });
    });
</script>

