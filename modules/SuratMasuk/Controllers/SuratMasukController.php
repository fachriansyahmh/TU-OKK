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
        /** @var view-string */
        $view = 'surat-masuk::create';

        return view($view);
    }

    public function store(Store $request): RedirectResponse
    {
        // Log::info($request->all());
        SuratMasuk::create($request->validated());

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

    public function update(Update $request, SuratMasuk $suratMasuk): RedirectResponse
    {
        // 1. Ambil semua data yang sudah tervalidasi
        $data = $request->validated();

        // 2. Cek jika ada file '_lampiran' yang diunggah
        if ($request->has('_lampiran')) {
            // Simpan file dan dapatkan path-nya
            // $path = $request->file('_lampiran')->store('lampiran_surat', 'public');
            // dd($data);
            // 3. Tambahkan path file ke array data dengan kunci 'lampiran'
            $dataLampiran = json_decode($data['_lampiran'], true);
            $dataURL = $dataLampiran[0]['file'] ?? null;
            $data['lampiran'] = $dataURL    ;
        }

        // 4. Hapus kunci sementara '_lampiran' dari array jika ada
        unset($data['_lampiran']);

        // 5. Update model dengan data yang sudah dimodifikasi
        $suratMasuk->update($data);

        return to_route('modules::surat-masuk.index')->withSuccess('Surat Masuk updated');
    }

    public function destroy(SuratMasuk $suratMasuk): RedirectResponse
    {
        $suratMasuk->delete();

        return to_route('modules::surat-masuk.index')->withSuccess('Surat Masuk deleted');
    }
}
