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
use Illuminate\Support\Facades\Auth;


class SuratMasukController extends Controller
{
    public function index(): Responsable|RedirectResponse
    {
        // Ambil per_page dari request, kalau tidak ada pakai default model
        $defaultPerPage = (new SuratMasuk())->getPerPage();
        $perPage = request()->integer('per_page', $defaultPerPage);

        // Hitung halaman terakhir
        $totalSurat = SuratMasuk::count();
        $lastPage = (int) ceil($totalSurat / max(1, $perPage)); // hindari pembagian 0

        $requestedPage = request()->integer('page');

        // Kondisi 1: tidak ada parameter page → redirect ke last page
        if (!$requestedPage && $lastPage > 0) {
            return to_route('modules::surat-masuk.index', [
                'page' => $lastPage,
                'per_page' => $perPage,
                'search' => request('search'),
            ]);
        }

        // Kondisi 2: ada page tapi lebih besar dari last page → redirect ke last page
        if ($requestedPage > $lastPage && $lastPage > 0) {
            return to_route('modules::surat-masuk.index', [
                'page' => $lastPage,
                'per_page' => $perPage,
                'search' => request('search'),
            ]);
        }

        // Kondisi 3: biarkan user tetap di page yang diminta
        return SuratMasukTableView::make()
            ->view('surat-masuk::index')
            ->showPerPage();
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
        $data['pengolah_id'] = auth()->id();

        // Logika untuk menangani lampiran
        if ($request->input('lampiran_type') === 'upload' && $request->has('_lampiran')) {
            $dataLampiran = json_decode($data['_lampiran'], true);
            $data['lampiran'] = $dataLampiran[0]['file'] ?? null;
        } elseif ($request->input('lampiran_type') === 'link') {
            $data['lampiran'] = $request->input('lampiran_link');
        } else {
            $data['lampiran'] = null;
        }

        unset($data['lampiran_type'], $data['lampiran_link'], $data['_lampiran']);

        SuratMasuk::create($data);

        // Logika redirect ke halaman terakhir
        $total = SuratMasuk::count();
        $perPage = (new SuratMasuk())->getPerPage();
        $lastPage = ceil($total / $perPage);

        return to_route('modules::surat-masuk.index', ['page' => $lastPage])->withSuccess('Surat Masuk saved');
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

    public function disposisi(SuratMasuk $suratMasuk): View
    {
        /** @var view-string $view */
        $view = 'surat-masuk::disposisi';

        return view($view, compact('suratMasuk'));
    }

    public function update(Update $request, SuratMasuk $suratMasuk): RedirectResponse
    {
        $data = $request->validated();
        $originalLampiran = $suratMasuk->lampiran;

        // Logika untuk menangani lampiran
        if ($request->input('lampiran_type') === 'upload' && $request->has('_lampiran')) {
            $dataLampiran = json_decode($data['_lampiran'], true);
            $data['lampiran'] = $dataLampiran[0]['file'] ?? $originalLampiran;
        } elseif ($request->input('lampiran_type') === 'link') {
            $data['lampiran'] = $request->input('lampiran_link');
        }

        // Logika untuk menghapus file lama jika berubah
        if (isset($data['lampiran']) && $originalLampiran !== $data['lampiran']) {
            // Cek jika lampiran lama adalah file yang di-upload (bukan link eksternal)
            if ($originalLampiran && str_starts_with($originalLampiran, url('storage'))) {
                $filePath = str_replace(url('/'), public_path(), $originalLampiran);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $isDisposisiAction = $request->has('disposisi_kepada') || $request->has('disposisi_id') || $request->has('isi_disposisi');

        if ($isDisposisiAction) {
            $disposisiData = $request->validate([
                'disposisi_kepada' => ['required', 'string', 'max:255'],
                'disposisi_id' => ['required', 'integer'],
                'isi_disposisi' => ['required', 'string'],
            ]);
            $data = array_merge($data, $disposisiData);
            $data['status'] = 'Kirim';
        }

        unset($data['lampiran_type'], $data['lampiran_link'], $data['_lampiran']);

        $suratMasuk->update($data);

        // Logika redirect ke halaman yang sama setelah edit
        $position = SuratMasuk::where('id', '<=', $suratMasuk->id)->count();
        $perPage = (new SuratMasuk())->getPerPage();
        $page = ceil($position / $perPage);

        return to_route('modules::surat-masuk.index', ['page' => $page])->withSuccess('Surat Masuk updated');
    }

    public function destroy(SuratMasuk $suratMasuk): RedirectResponse
    {
        $suratMasuk->delete();
        return to_route('modules::surat-masuk.index')->withSuccess('Surat Masuk deleted');
    }
}
