<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\IndexRequest;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(IndexRequest $request): View
    {
        return view('profile/index');
    }
}
