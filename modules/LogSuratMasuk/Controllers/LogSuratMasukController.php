<?php

namespace Modules\LogSuratMasuk\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\LogSuratMasuk\Models\LogSuratMasuk;
use Modules\LogSuratMasuk\Requests\Store;
use Modules\LogSuratMasuk\Requests\Update;
use Modules\LogSuratMasuk\Tables\LogSuratMasukTableView;

class LogSuratMasukController extends Controller
{
    public function index(): Responsable
    {
        return LogSuratMasukTableView::make()->view('log-surat-masuk::index');
    }

    public function create(): View
    {
        /** @var view-string */
        $view = 'log-surat-masuk::create';

        return view($view);
    }

    public function store(Store $request): RedirectResponse
    {
        LogSuratMasuk::create($request->validated());

        return to_route('modules::log-surat-masuk.index')->withSuccess('Log Surat Masuk saved');
    }

    public function show(LogSuratMasuk $logSuratMasuk): View
    {
        /** @var view-string $view */
        $view = 'log-surat-masuk::show';

        return view($view, compact('logSuratMasuk'));
    }

    public function edit(LogSuratMasuk $logSuratMasuk): View
    {
        /** @var view-string $view */
        $view = 'log-surat-masuk::edit';

        return view($view, compact('logSuratMasuk'));
    }

    public function update(Update $request, LogSuratMasuk $logSuratMasuk): RedirectResponse
    {
        $logSuratMasuk->update($request->validated());

        return to_route('modules::log-surat-masuk.index')->withSuccess('Log Surat Masuk updated');
    }

    public function destroy(LogSuratMasuk $logSuratMasuk): RedirectResponse
    {
        $logSuratMasuk->delete();

        return to_route('modules::log-surat-masuk.index')->withSuccess('Log Surat Masuk deleted');
    }
}
