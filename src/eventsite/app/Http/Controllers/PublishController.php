<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Prefecture;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    public function index()
    {
        $prefectures = Prefecture::get();
        $categories = Category::get();

        return view('publish.index')
            ->with([
                'prefectures' => $prefectures,
                'categories' => $categories]);
    }
}
