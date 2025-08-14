<?php

namespace Modules\Pengolah\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Pengolah\Models\Pengolah;
use Modules\Pengolah\Requests\Store;
use Modules\Pengolah\Requests\Update;
use Modules\Pengolah\Tables\PengolahTableView;

class PengolahController extends Controller
{
    public function index(): Responsable
    {
        return PengolahTableView::make()->view('pengolah::index');
    }

    public function create(): View
    {
        /** @var view-string */
        $view = 'pengolah::create';

        return view($view);
    }

    public function store(Store $request): RedirectResponse
    {
        Pengolah::create($request->validated());

        return to_route('modules::pengolah.index')->withSuccess('Pengolah saved');
    }

    public function show(Pengolah $pengolah): View
    {
        /** @var view-string $view */
        $view = 'pengolah::show';

        return view($view, compact('pengolah'));
    }

    public function edit(Pengolah $pengolah): View
    {
        /** @var view-string $view */
        $view = 'pengolah::edit';

        return view($view, compact('pengolah'));
    }

    public function update(Update $request, Pengolah $pengolah): RedirectResponse
    {
        $pengolah->update($request->validated());

        return to_route('modules::pengolah.index')->withSuccess('Pengolah updated');
    }

    public function destroy(Pengolah $pengolah): RedirectResponse
    {
        $pengolah->delete();

        return to_route('modules::pengolah.index')->withSuccess('Pengolah deleted');
    }
}
