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
    public function index(): Responsable
    {
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
        $data = $request->validated();

        if ($request->has('_lampiran')) {
            $dataLampiran = json_decode($data['_lampiran'], true);
            $dataURL = $dataLampiran[0]['file'] ?? null;
            $data['lampiran'] = $dataURL;
        } else {
            $data['lampiran'] = null;
        }

        unset($data['_lampiran']);

        SuratMasuk::create($data);

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

        // Cek apakah ini adalah aksi disposisi dengan memeriksa salah satu field disposisi.
        $isDisposisiAction = $request->has('disposisi_kepada')
                            || $request->has('disposisi_id')
                            || $request->has('isi_disposisi');

        if ($isDisposisiAction) {
            // Jika ini adalah aksi disposisi, validasi bahwa semua field disposisi wajib diisi.
            $disposisiData = $request->validate([
                'disposisi_kepada' => ['required', 'string', 'max:255'],
                'disposisi_id' => ['required', 'integer'],
                'isi_disposisi' => ['required', 'string'],
            ]);

            // Gabungkan data yang sudah divalidasi
            $data = array_merge($data, $disposisiData);

            // Jika validasi lolos, ubah status menjadi 'Kirim'
            $data['status'] = 'Kirim';
        }


        unset($data['_lampiran']);

        $suratMasuk->update($data);

        return to_route('modules::surat-masuk.index')->withSuccess('Surat Masuk updated');
    }

    public function destroy(SuratMasuk $suratMasuk): RedirectResponse
    {
        $suratMasuk->delete();

        return to_route('modules::surat-masuk.index')->withSuccess('Surat Masuk deleted');
    }
}
