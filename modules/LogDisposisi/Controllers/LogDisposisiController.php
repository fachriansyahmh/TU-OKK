<?php

namespace Modules\LogDisposisi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\LogDisposisi\Models\LogDisposisi;
use Modules\LogDisposisi\Requests\Store;
use Modules\LogDisposisi\Requests\Update;
use Modules\LogDisposisi\Tables\LogDisposisiTableView;

class LogDisposisiController extends Controller
{
    public function index(): Responsable
    {
        return LogDisposisiTableView::make()->view('log-disposisi::index');
    }

    public function create(): View
    {
        /** @var view-string */
        $view = 'log-disposisi::create';

        return view($view);
    }

    public function store(Store $request): RedirectResponse
    {
        LogDisposisi::create($request->validated());

        return to_route('modules::log-disposisi.index')->withSuccess('Log Disposisi saved');
    }

    public function show(LogDisposisi $logDisposisi): View
    {
        /** @var view-string $view */
        $view = 'log-disposisi::show';

        return view($view, compact('logDisposisi'));
    }

    public function edit(LogDisposisi $logDisposisi): View
    {
        /** @var view-string $view */
        $view = 'log-disposisi::edit';

        return view($view, compact('logDisposisi'));
    }

    public function update(Update $request, LogDisposisi $logDisposisi): RedirectResponse
    {
        $logDisposisi->update($request->validated());

        return to_route('modules::log-disposisi.index')->withSuccess('Log Disposisi updated');
    }

    public function destroy(LogDisposisi $logDisposisi): RedirectResponse
    {
        $logDisposisi->delete();

        return to_route('modules::log-disposisi.index')->withSuccess('Log Disposisi deleted');
    }
}
