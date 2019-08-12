<?php

namespace App\Http\Controllers;

use App\Charity;

class CharityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $charities = Charity::all();
        return view('charities.index', ['charities' => $charities]);
    }

    public function show($charity_id )
    {
        $charity = Charity::find($charity_id);
        return view('charities.show', ['charity' => $charity]);
    }

    public function create()
    {
        // nothing to do here as DB is already seeded.
    }

    public function store()
    {
        // nothing to do here as DB is already seeded.
    }
}
