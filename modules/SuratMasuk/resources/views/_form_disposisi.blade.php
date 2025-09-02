{{-- 1. Buat input tersembunyi (hidden) yang akan menyimpan nilai akhir --}}
<input type="hidden" name="disposisi_kepada" id="disposisi_kepada_hidden">

{{-- 2. Buat grup field untuk checkbox --}}
<div class="field">
    <label>Disposisi Kepada</label>
    <div class="ui grid" id="disposisi-group">
        <div class="four wide column">
            <div class="ui checkbox">
                <input type="checkbox" value="Ortala">
                <label>Ortala</label>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui checkbox">
                <input type="checkbox" value="PSDM">
                <label>PSDM</label>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui checkbox">
                <input type="checkbox" value="Hukum">
                <label>Hukum</label>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui checkbox">
                <input type="checkbox" value="AKK">
                <label>AKK</label>
            </div>
        </div>
    </div>
</div>

{{-- 3. Buat input teks untuk "Lainnya" --}}
<div class="field">
    <label>Lainnya</label>
    <input type="text" id="disposisi_lainnya" placeholder="Isi disposisi lainnya jika ada...">
</div>


{{-- Dropdown ini akan mengambil data dari tabel `disposisi` --}}
{!! form()->dropdownDB('disposisi_id', 'select id, disposisi from disposisi', 'id', 'disposisi')->label('Disposisi')->placeholder('--Pilih--') !!}

{!! form()->textarea('isi_disposisi')->label('Isi Disposisi') !!}

{!!
    form()->action([
        form()->submit('Simpan Disposisi'),
        form()->link('Batal', route('modules::surat-masuk.index'))
    ])
!!}

{{-- 4. Tambahkan JavaScript untuk menggabungkan nilai --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxGroup = document.getElementById('disposisi-group');
        const lainnyaInput = document.getElementById('disposisi_lainnya');
        const hiddenInput = document.getElementById('disposisi_kepada_hidden');

        function updateHiddenInput() {
            const selectedValues = [];

            // Ambil nilai dari checkbox yang dicentang
            checkboxGroup.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                selectedValues.push(checkbox.value);
            });

            // Ambil nilai dari input teks "Lainnya" jika diisi
            if (lainnyaInput.value.trim() !== '') {
                selectedValues.push(lainnyaInput.value.trim());
            }

            // Gabungkan semua nilai dengan koma dan spasi
            hiddenInput.value = selectedValues.join(', ');
        }

        // Tambahkan event listener ke setiap checkbox dan input teks
        checkboxGroup.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateHiddenInput);
        });

        lainnyaInput.addEventListener('input', updateHiddenInput);
    });
</script>
