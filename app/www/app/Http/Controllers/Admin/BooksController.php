<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Repository\IAuthorRepository;
use App\Repository\IBookRepository;
use App\Repository\IGenreRepository;
use App\Repository\IPublisherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    private IBookRepository $bookRepository;
    private IAuthorRepository $authorRepository;
    private IPublisherRepository $publisherRepository;
    private IGenreRepository $genreRepository;

    public function __construct(
        IBookRepository $bookRepository,
        IAuthorRepository $authorRepository,
        IPublisherRepository $publisherRepository,
        IGenreRepository $genreRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
        $this->publisherRepository = $publisherRepository;
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $books = $this->bookRepository->paginate(20);
        return view('admin.books.index', compact('books'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $authors = $this->authorRepository->all();
        $publishers = $this->publisherRepository->all();
        $genres = $this->genreRepository->all();
        return view('admin.books.create', compact('authors', 'publishers', 'genres'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date_publish' => ['required', 'date'],
            'cover_img' => ['image', 'nullable'],
            'file' => ['mimes:pdf,epub,fb2'],
            'pages_quantity' => ['integer', 'nullable'],
            'description' => ['string', 'max:1000', 'nullable'],
            'age_rating' => ['string', 'max:255', 'nullable'],
            'novelty' => ['boolean', 'nullable'],
            'popular' => ['boolean', 'nullable'],
            'recommended' => ['boolean', 'nullable'],
            'author' => ['integer'],
            'publisher' => ['integer'],
            'genres' => ['array'],
        ]);

        if ($request->hasFile('cover_img')) {
            $this->bookRepository->uploadCoverImg($request->file('cover_img'));
        } else {
            $this->bookRepository->uploadCoverImg($this->bookRepository->getDefaultCoverImg());
        }

        if ($request->hasFile('file')) {
            $this->bookRepository->uploadFile($request->file('file'));
        }

        $book = $this->bookRepository->create([
            'name' => $request->name,
            'date_publish' => $request->date_publish,
            'cover_img' => $this->bookRepository->cover_img,
            'file' => $this->bookRepository->file,
            'pages_quantity' => $request->pages_quantity,
            'description' => $request->description,
            'age_rating' => $request->age_rating,
            'novelty' => $request->novelty,
            'popular' => $request->popular,
            'recommended' => $request->recommended,
        ]);
        $book->author_id = $request->author;
        $book->publisher_id = $request->publisher;
        $book->save();
        $book->genres()->attach($request->genres);

        return redirect()->route('admin_panel.books.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $book = $this->bookRepository->find($id);
        $bookGenres = $book->genres()->get()->toArray();
        $bookGenresId = [];
        foreach ($bookGenres as $bookGenre)
            $bookGenresId[$bookGenre['pivot']['genre_id']] = $bookGenre;
        $authors = $this->authorRepository->all();
        $publishers = $this->publisherRepository->all();
        $genres = $this->genreRepository->all();
        return view('admin.books.edit', compact('book', 'authors', 'publishers', 'genres', 'bookGenresId'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date_publish' => ['required', 'date'],
            'file' => ['mimes:pdf,epub,fb2'],
            'cover_img' => ['image', 'nullable'],
            'pages_quantity' => ['integer', 'nullable'],
            'description' => ['string', 'max:1000', 'nullable'],
            'age_rating' => ['string', 'max:255', 'nullable'],
            'novelty' => ['boolean', 'nullable'],
            'popular' => ['boolean', 'nullable'],
            'recommended' => ['boolean', 'nullable'],
            'author' => ['integer'],
            'publisher' => ['integer'],
        ]);

        DB::transaction(function() use ($id, $request) {
            $book = $this->bookRepository->find($id);
            foreach ($request->all() as $key => $item) {
                if (
                    ($request->filled($key) || $request->hasFile($key)) &&
                    in_array($key, array_merge($book->getFillable(), ['author', 'publisher', 'genres']))
                ) {
                    switch ($key) {
                        case 'cover_img':
                            if ($request->hasFile($key)) {
                                $this->bookRepository->removeCoverImg($book);
                                $this->bookRepository->uploadCoverImg($request->file($key));
                                $book->$key = $this->bookRepository->$key;
                            }
                            break;
                        case 'file':
                            if ($request->hasFile($key)) {
                                $this->bookRepository->removeFile($book);
                                $this->bookRepository->uploadFile($request->file($key));
                                $book->$key = $this->bookRepository->$key;
                            }
                            break;
                        case 'author':
                            $book->author_id = $item;
                            break;
                        case 'publisher':
                            $book->publisher_id = $item;
                            break;
                        case 'genres':
                            $book->genres()->detach();
                            $book->genres()->attach($item);
                            break;
                        default:
                            $book->$key = $item;
                            break;
                    }
                }
            }
            $book->save();
        });

        return redirect()->route('admin_panel.books.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $book = $this->bookRepository->find($id);
        $this->bookRepository->remove($book);
        return redirect()->route('admin_panel.books.index');
    }
}
