<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\IGenreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    private IGenreRepository $genreRepository;

    public function __construct(IGenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $genres = $this->genreRepository->all();

        return view('admin.genres.index', compact('genres'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.genres.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $this->genreRepository->create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin_panel.genres.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $genre = $this->genreRepository->find($id);

        return view('admin.genres.edit', compact('genre'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'nullable'],
        ]);

        DB::transaction(function () use ($id, $request) {
            $genre = $this->genreRepository->find($id);
            foreach ($request->all() as $key => $item) {
                if (($request->filled($key) || $request->hasFile($key)) && in_array($key, $genre->getFillable())) {
                    switch ($key) {
                        default:
                            $genre->$key = $item;
                            break;
                    }
                }
            }
            $genre->save();
        });

        return redirect()->route('admin_panel.genres.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $genre = $this->genreRepository->find($id);
        $this->genreRepository->remove($genre);

        return redirect()->route('admin_panel.genres.index');
    }
}
