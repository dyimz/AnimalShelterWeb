<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use DB;

class HomeController1 extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $animals = DB::table('animals')->leftJoin('adopted_animal', 'animals.id', 'adopted_animal.animal_id')->select('animals.*')->where('status', 'adoptable')->get();
        return view('home', compact('animals'));
    }
}
