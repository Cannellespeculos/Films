<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRequest;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Film;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug = null): View
    {
        $model = null;
        if($slug) {
            if(Route::currentRouteName() == 'films.category') {
                $model = new Category;
            } else {
                $model = new Actor;
            }
        }
        $query = $model ? $model->whereSlug($slug)->firstOrFail()->films() : Film::query();
        $test = $query->withTrashed();
        $all = count($test->get());
        $films = $test->oldest('title')->paginate(5);
        return view('index', compact('films', 'slug', 'all'));
    }
    public function create(): View
    {
        return view('create');
    }
    public function store(FilmRequest $filmRequest): RedirectResponse
    {
        $film = Film::create($filmRequest->all());
        $film->categories()->attach($filmRequest->cats);
        $film->actors()->attach($filmRequest->acts);
        return redirect()->route('films.index')->with('info', 'Le film a bien été créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film): View
    {
        return view('show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film): View
    {
        return view('edit', compact('film'));
    }
    public function update(FilmRequest $filmRequest, Film $film): RedirectResponse
    {
        $film->update($filmRequest->all());
        $film->categories()->sync($filmRequest->cats);
        $film->actors()->sync($filmRequest->acts);
        return redirect()->route('films.index')->with('info', 'Le film a bien été modifié');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film): RedirectResponse
    {
        $film->delete();
        return back()->with('info', 'Le film a bien été mis dans la corbeille.');
    }

    public function forceDestroy($id): RedirectResponse
    {
        Film::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'Le film a bien été supprimé définitivement dans la base de données.');
    }
    public function restore($id): RedirectResponse
    {
        Film::withTrashed()->whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'Le film a bien été restauré.');
    }
}
