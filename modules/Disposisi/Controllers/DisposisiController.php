<?php

namespace Modules\Disposisi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Disposisi\Models\Disposisi;
use Modules\Disposisi\Requests\Store;
use Modules\Disposisi\Requests\Update;
use Modules\Disposisi\Tables\DisposisiTableView;

class DisposisiController extends Controller
{
    public function index(): Responsable
    {
        return DisposisiTableView::make()->view('disposisi::index');
    }

    public function create(): View
    {
        /** @var view-string */
        $view = 'disposisi::create';

        return view($view);
    }

    public function store(Store $request): RedirectResponse
    {
        Disposisi::create($request->validated());

        return to_route('modules::disposisi.index')->withSuccess('Disposisi saved');
    }

    public function show(Disposisi $disposisi): View
    {
        /** @var view-string $view */
        $view = 'disposisi::show';

        return view($view, compact('disposisi'));
    }

    public function edit(Disposisi $disposisi): View
    {
        /** @var view-string $view */
        $view = 'disposisi::edit';

        return view($view, compact('disposisi'));
    }

    public function update(Update $request, Disposisi $disposisi): RedirectResponse
    {
        $disposisi->update($request->validated());

        return to_route('modules::disposisi.index')->withSuccess('Disposisi updated');
    }

    public function destroy(Disposisi $disposisi): RedirectResponse
    {
        $disposisi->delete();

        return to_route('modules::disposisi.index')->withSuccess('Disposisi deleted');
    }
}
