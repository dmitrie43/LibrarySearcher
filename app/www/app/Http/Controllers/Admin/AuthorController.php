<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\IAuthorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    private IAuthorRepository $authorRepository;

    public function __construct(IAuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $authors = $this->authorRepository->all();

        return view('admin.authors.index', compact('authors'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'photo' => ['image'],
        ]);

        if ($request->hasFile('photo')) {
            $this->authorRepository->uploadPhoto($request->file('photo'));
        }
        $photo = $this->authorRepository->photo ? $this->authorRepository->photo : null;

        $this->authorRepository->create([
            'full_name' => $request->full_name,
            'photo' => $photo,
        ]);

        return redirect()->route('admin_panel.authors.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $author = $this->authorRepository->find($id);

        return view('admin.authors.edit', compact('author'));
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
            'photo' => ['image', 'nullable'],
        ]);

        DB::transaction(function () use ($id, $request) {
            $author = $this->authorRepository->find($id);
            foreach ($request->all() as $key => $item) {
                if (($request->filled($key) || $request->hasFile($key)) && in_array($key, $author->getFillable())) {
                    switch ($key) {
                        case 'photo':
                            if ($request->hasFile($key)) {
                                $this->authorRepository->removePhoto($author);
                                $this->authorRepository->uploadPhoto($request->file($key));
                                $author->$key = $this->authorRepository->$key;
                            }
                            break;
                        default:
                            $author->$key = $item;
                            break;
                    }
                }
            }
            $author->save();
        });

        return redirect()->route('admin_panel.authors.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $author = $this->authorRepository->find($id);
        $this->authorRepository->remove($author);

        return redirect()->route('admin_panel.authors.index');
    }
}
