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
        // PERBAIKAN: Hanya redirect jika tidak ada parameter 'page' DAN tidak ada 'search'
        if (!request()->has('page') && !request()->has('search')) {
            // Hitung halaman terakhir
            $totalSurat = SuratMasuk::count();
            $perPage = (new SuratMasuk())->getPerPage();
            $lastPage = ceil($totalSurat / $perPage);

            // Redirect ke halaman terakhir jika ada data
            if ($lastPage > 0) {
                return to_route('modules::surat-masuk.index', ['page' => $lastPage]);
            }
        }

        // Jika ada parameter 'page' atau 'search', tampilkan tabel seperti biasa
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
