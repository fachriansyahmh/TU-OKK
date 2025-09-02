<?php

namespace Modules\SuratMasuk\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Modules\SuratMasuk\Models\SuratMasuk;
use Modules\SuratMasuk\Requests\Store;
use Modules\SuratMasuk\Requests\Update;
use Modules\SuratMasuk\Tables\SuratMasukTableView;

class SuratMasukController extends Controller
{
    public function index(): Responsable|RedirectResponse
    {
        // Cek jika parameter 'page' belum ada di URL
        if (!request()->has('page')) {
            // Hitung halaman terakhir
            $totalSurat = SuratMasuk::count();
            $perPage = (new SuratMasuk())->getPerPage();
            $lastPage = ceil($totalSurat / $perPage);

            // Redirect ke halaman terakhir jika ada data
            if ($lastPage > 0) {
                return to_route('modules::surat-masuk.index', ['page' => $lastPage]);
            }
        }

        // Jika parameter 'page' sudah ada, atau tidak ada data, tampilkan tabel seperti biasa
        return SuratMasukTableView::make()->view('surat-masuk::index');
    }

    public function create(): View
    {
        $suratMasuk = new SuratMasuk();

        /** @var view-string */
        $view = 'surat-masuk::create';

        return view($view, compact('suratMasuk'));
    }

    public function store(Store $request): RedirectResponse
    {
        // Mengambil semua data yang sudah lolos validasi dari form
        $data = $request->validated();

        // 2. Menambahkan ID pengguna yang sedang login ke dalam data
        // `auth()->id()` akan mengambil ID dari user yang saat ini terautentikasi.
        $data['pengolah_id'] = auth()->id();

        if ($request->has('_lampiran')) {
            $dataLampiran = json_decode($data['_lampiran'], true);
            $dataURL = $dataLampiran[0]['file'] ?? null;
            $data['lampiran'] = $dataURL;
        } else {
            $data['lampiran'] = null;
        }

        unset($data['_lampiran']);

        // 3. Membuat record baru di database dengan data yang sudah dimodifikasi
        SuratMasuk::create($data);

        // Arahkan kembali ke halaman indeks
        return to_route('modules::surat-masuk.index')->withSuccess('Surat Masuk saved');
    }


    public function show(SuratMasuk $suratMasuk): View
    {
        /** @var view-string $view */
        $view = 'surat-masuk::show';

        return view($view, compact('suratMasuk'));
    }

    public function edit(SuratMasuk $suratMasuk): View
    {
        /** @var view-string $view */
        $view = 'surat-masuk::edit';

        return view($view, compact('suratMasuk'));
    }

    /**
     * Menampilkan halaman form disposisi.
     */
    public function disposisi(SuratMasuk $suratMasuk): View
    {
        /** @var view-string $view */
        $view = 'surat-masuk::disposisi';

        return view($view, compact('suratMasuk'));
    }

    public function update(Update $request, SuratMasuk $suratMasuk): RedirectResponse
    {
        $data = $request->validated();

        if ($request->has('_lampiran')) {
            $dataLampiran = json_decode($data['_lampiran'], true);
            $dataURL = $dataLampiran[0]['file'] ?? null;
            $data['lampiran'] = $dataURL;
        }

        $isDisposisiAction = $request->has('disposisi_kepada')
                            || $request->has('disposisi_id')
                            || $request->has('isi_disposisi');

        if ($isDisposisiAction) {
            $disposisiData = $request->validate([
                'disposisi_kepada' => ['required', 'string', 'max:255'],
                'disposisi_id' => ['required', 'integer'],
                'isi_disposisi' => ['required', 'string'],
            ]);
            $data = array_merge($data, $disposisiData);
            $data['status'] = 'Kirim';
        }

        unset($data['_lampiran']);

        $suratMasuk->update($data);

        // --- BAGIAN YANG DIUBAH DIMULAI DARI SINI ---

        // 1. Hitung posisi surat yang baru diupdate berdasarkan ID
        $position = SuratMasuk::where('id', '<=', $suratMasuk->id)->count();

        // 2. Ambil jumlah item per halaman dari model
        $perPage = (new SuratMasuk())->getPerPage();

        // 3. Hitung di halaman berapa surat tersebut berada
        $page = ceil($position / $perPage);

        // 4. Arahkan kembali ke halaman yang benar
        return to_route('modules::surat-masuk.index', ['page' => $page])->withSuccess('Surat Masuk updated');
    }

    public function destroy(SuratMasuk $suratMasuk): RedirectResponse
    {
        $suratMasuk->delete();

        return to_route('modules::surat-masuk.index')->withSuccess('Surat Masuk deleted');
    }
}
