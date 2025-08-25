<?php

namespace Modules\DisposisiKepada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\DisposisiKepada\Models\DisposisiKepada;
use Modules\DisposisiKepada\Requests\Store;
use Modules\DisposisiKepada\Requests\Update;
use Modules\DisposisiKepada\Tables\DisposisiKepadaTableView;

class DisposisiKepadaController extends Controller
{
    public function index(): Responsable
    {
        return DisposisiKepadaTableView::make()->view('disposisi-kepada::index');
    }

    public function create(): View
    {
        /** @var view-string */
        $view = 'disposisi-kepada::create';

        return view($view);
    }

    public function store(Store $request): RedirectResponse
    {
        DisposisiKepada::create($request->validated());

        return to_route('modules::disposisi-kepada.index')->withSuccess('Disposisi Kepada saved');
    }

    public function show(DisposisiKepada $disposisiKepada): View
    {
        /** @var view-string $view */
        $view = 'disposisi-kepada::show';

        return view($view, compact('disposisiKepada'));
    }

    public function edit(DisposisiKepada $disposisiKepada): View
    {
        /** @var view-string $view */
        $view = 'disposisi-kepada::edit';

        return view($view, compact('disposisiKepada'));
    }

    public function update(Update $request, DisposisiKepada $disposisiKepada): RedirectResponse
    {
        $disposisiKepada->update($request->validated());

        return to_route('modules::disposisi-kepada.index')->withSuccess('Disposisi Kepada updated');
    }

    public function destroy(DisposisiKepada $disposisiKepada): RedirectResponse
    {
        $disposisiKepada->delete();

        return to_route('modules::disposisi-kepada.index')->withSuccess('Disposisi Kepada deleted');
    }
}
