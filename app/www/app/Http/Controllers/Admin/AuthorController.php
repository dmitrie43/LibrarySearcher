<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authors\StoreRequest;
use App\Http\Requests\Authors\UpdateRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::query()->get();

        return view('admin.authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('admin.authors.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = FileUploader::upload($request->file('photo'), FileUploader::IMAGE_PATH);
        }

        Author::create(array_merge($request->validated(), ['photo' => $photo]));

        return redirect()->route('admin_panel.authors.index');
    }

    public function edit(Author $author): View
    {
        return view('admin.authors.edit', compact('author'));
    }

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

    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('admin_panel.authors.index');
    }
}
