<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Animal;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$results = (new Search())
   		->registerModel(Animal::class, 'type', 'breed', 'name', 'gender', 'age', 'date_rescued', 'place_rescued', 'date_checked', 'status')
   		->search($request->input('search'));
   		return view('search', compact('results'));
    }

    public function show($id)
    {
    	$animal = \App\Models\Animal::find($id);
    	return view('show', compact('animal'));
    }
}
