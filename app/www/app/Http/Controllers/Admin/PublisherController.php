<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publishers\StoreRequest;
use App\Http\Requests\Publishers\UpdateRequest;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublisherController extends Controller
{
    public function index(): View
    {
        $publishers = Publisher::query()->get();

        return view('admin.publishers.index', compact('publishers'));
    }

    public function create(): View
    {
        return view('admin.publishers.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Publisher::create($request->validated());

        return redirect()->route('admin_panel.publishers.index');
    }

    public function edit(Publisher $publisher): View
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(UpdateRequest $request, Publisher $publisher): RedirectResponse
    {
        $publisher->update($request->validated());

        return redirect()->route('admin_panel.publishers.index');
    }

    public function destroy(Publisher $publisher): RedirectResponse
    {
        $publisher->delete();

        return redirect()->route('admin_panel.publishers.index');
    }
}
