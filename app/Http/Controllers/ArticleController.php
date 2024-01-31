<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function show($n): View
    {
        return view('article')->with('numero', $n);
    }
}
