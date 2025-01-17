<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authors\StoreRequest;
use App\Http\Requests\Authors\UpdateRequest;
use App\Models\Author;
use App\Helpers\FileUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $authors = Author::query()->get();

        return view('admin.authors.index', compact('authors'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.authors.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = FileUploader::upload($request->file('photo'), FileUploader::IMAGE_PATH);
        }

        Author::create(array_merge($request->validated(), ['photo' => $photo]));

        return redirect()->route('admin_panel.authors.index');
    }

    /**
     * @param Author $author
     * @return View
     */
    public function edit(Author $author): View
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * @param UpdateRequest $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Author $author): RedirectResponse
    {
        $photo = $author->getOriginal('photo');
        if ($request->hasFile('photo')) {
            if ($photo) {
                $author->removeImage('photo');
            }
            $photo = FileUploader::upload($request->file('photo'), FileUploader::IMAGE_PATH);
        }

        $author->update(array_merge($request->validated(), ['photo' => $photo]));

        return redirect()->route('admin_panel.authors.index');
    }

    /**
     * @param Author $author
     * @return RedirectResponse
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('admin_panel.authors.index');
    }
}
