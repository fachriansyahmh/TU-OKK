<x-volt-app title="Dashboard">

    {{-- Judul Halaman --}}
    <h2 class="ui header">Dashboard Ringkasan</h2>

    {{-- PERBAIKAN: Menggunakan kelas "four" untuk membuat grid 4 kolom --}}
    <div class="ui four small statistics">

        <div class="statistic">
            <div class="value">
                <i class="envelope icon"></i> {{ $totalSurat }}
            </div>
            <div class="label">
                Total Surat Masuk
            </div>
        </div>

        <div class="statistic">
            <div class="value">
                <i class="file outline icon"></i> {{ $belumDisposisi }}
            </div>
            <div class="label">
                Belum Didisposisi
            </div>
        </div>

        <div class="statistic">
            <div class="value">
                <i class="check circle outline icon"></i> {{ $sudahDisposisi }}
            </div>
            <div class="label">
                Sudah Didisposisi
            </div>
        </div>

        <div class="statistic">
            <div class="value">
                <i class="calendar day icon"></i> {{ $suratHariIni }}
            </div>
            <div class="label">
                Surat Masuk Hari Ini
            </div>
        </div>

    </div>

    {{-- Tambahkan divider untuk memisahkan dengan konten lain jika ada --}}
    <div class="ui divider"></div>

</x-volt-app>