<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

class ArtController extends Controller
{
    public function index()
    {
        $message = 'success';

        return view('forum.art', compact('message'));
    }

}