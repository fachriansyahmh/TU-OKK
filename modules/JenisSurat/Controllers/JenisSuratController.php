<?php

namespace Modules\JenisSurat\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\JenisSurat\Models\JenisSurat;
use Modules\JenisSurat\Requests\Store;
use Modules\JenisSurat\Requests\Update;
use Modules\JenisSurat\Tables\JenisSuratTableView;

class JenisSuratController extends Controller
{
    public function index(): Responsable
    {
        return JenisSuratTableView::make()->view('jenis-surat::index');
    }

    public function create(): View
    {
        /** @var view-string */
        $view = 'jenis-surat::create';

        return view($view);
    }

    public function store(Store $request): RedirectResponse
    {
        JenisSurat::create($request->validated());

        return to_route('modules::jenis-surat.index')->withSuccess('Jenis Naskah saved');
    }

    public function show(JenisSurat $jenisSurat): View
    {
        /** @var view-string $view */
        $view = 'jenis-surat::show';

        return view($view, compact('jenisSurat'));
    }

    public function edit(JenisSurat $jenisSurat): View
    {
        /** @var view-string $view */
        $view = 'jenis-surat::edit';

        return view($view, compact('jenisSurat'));
    }

    public function update(Update $request, JenisSurat $jenisSurat): RedirectResponse
    {
        $jenisSurat->update($request->validated());

        return to_route('modules::jenis-surat.index')->withSuccess('Jenis Naskah updated');
    }

    public function destroy(JenisSurat $jenisSurat): RedirectResponse
    {
        $jenisSurat->delete();

        return to_route('modules::jenis-surat.index')->withSuccess('Jenis Naskah deleted');
    }
}
