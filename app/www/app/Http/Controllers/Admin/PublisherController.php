<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\IPublisherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    private IPublisherRepository $publisherRepository;

    public function __construct(IPublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $publishers = $this->publisherRepository->all();

        return view('admin.publishers.index', compact('publishers'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.publishers.create');
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

        $this->publisherRepository->create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin_panel.publishers.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $publisher = $this->publisherRepository->find($id);

        return view('admin.publishers.edit', compact('publisher'));
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
            $publisher = $this->publisherRepository->find($id);
            foreach ($request->all() as $key => $item) {
                if (($request->filled($key) || $request->hasFile($key)) && in_array($key, $publisher->getFillable())) {
                    switch ($key) {
                        default:
                            $publisher->$key = $item;
                            break;
                    }
                }
            }
            $publisher->save();
        });

        return redirect()->route('admin_panel.publishers.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $publisher = $this->publisherRepository->find($id);
        $this->publisherRepository->remove($publisher);

        return redirect()->route('admin_panel.publishers.index');
    }
}
