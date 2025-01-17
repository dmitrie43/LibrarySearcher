<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genres\StoreRequest;
use App\Http\Requests\Genres\UpdateRequest;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GenreController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $genres = Genre::query()->get();

        return view('admin.genres.index', compact('genres'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.genres.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Genre::create($request->validated());

        return redirect()->route('admin_panel.genres.index');
    }

    /**
     * @param Genre $genre
     * @return View
     */
    public function edit(Genre $genre): View
    {
        return view('admin.genres.edit', compact('genre'));
    }

    /**
     * @param UpdateRequest $request
     * @param Genre $genre
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Genre $genre): RedirectResponse
    {
        $genre->update($request->validated());

        return redirect()->route('admin_panel.genres.index');
    }

    /**
     * @param Genre $genre
     * @return RedirectResponse
     */
    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();

        return redirect()->route('admin_panel.genres.index');
    }
}
