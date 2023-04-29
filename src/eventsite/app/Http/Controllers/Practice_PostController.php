<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice_PostController extends Controller
{
    public function index()
    {
        $posts = [
            'Title A',
            'Title B',
            'Title C',
        ];

        return view('practice_index')
            ->with(['posts' => $posts]);
    }
}
