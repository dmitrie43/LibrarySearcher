<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::query()->orderBy('id', 'DESC')->paginate(20);

        return view('admin.books.index', compact('books'));
    }

    public function create(): View
    {
        $authors = Author::query()->get();
        $publishers = Publisher::query()->get();
        $genres = Genre::query()->get();

        return view('admin.books.create', compact('authors', 'publishers', 'genres'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $coverImage = null;
        if ($request->hasFile('cover_img')) {
            $coverImage = FileUploader::upload($request->file('cover_img'), FileUploader::BOOK_COVER_PATH);
        }

        $file = null;
        if ($request->hasFile('file')) {
            $file = FileUploader::upload($request->file('file'), FileUploader::BOOK_FILE_PATH);
        }

        /** @var Book $book */
        $book = Book::create(array_merge($request->validated(), ['cover_img' => $coverImage, 'file' => $file]));

        $book->genres()->attach($request->input('genres'));

        return redirect()->route('admin_panel.books.index');
    }

    public function edit(Book $book): View
    {
        $bookGenreIds = array_flip($book->genres->pluck('id')->toArray());
        $authors = Author::query()->get();
        $publishers = Publisher::query()->get();
        $genres = Genre::query()->get();

        return view('admin.books.edit', compact('book', 'authors', 'publishers', 'genres', 'bookGenreIds'));
    }

    public function update(UpdateRequest $request, Book $book): RedirectResponse
    {
        $coverImg = $book->getOriginal('cover_img');
        if ($request->hasFile('cover_img')) {
            if ($coverImg) {
                $book->removeImage('cover_img');
            }
            $coverImg = FileUploader::upload($request->file('cover_img'), FileUploader::BOOK_COVER_PATH);
        }

        $file = $book->getOriginal('file');
        if ($request->hasFile('file')) {
            if ($file) {
                $book->removeFile('file');
            }
            $file = FileUploader::upload($request->file('file'), FileUploader::BOOK_FILE_PATH);
        }

        $book->update(
            array_merge(
                $request->validated(),
                [
                    'cover_img' => $coverImg,
                    'file' => $file,
                ]
            )
        );

        $book->genres()->sync($request->input('genres'));

        return redirect()->route('admin_panel.books.index');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('admin_panel.books.index');
    }
}
