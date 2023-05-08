<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopter;
use App\Models\Animal;
use Auth;
use View;
use Redirect;
use DB;
use DataTables;

class AdopterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $adopters = DB::table('adopters')->get();
        // dd($adopters);
        // $adopted_animal = DB::table('adopters')->leftJoin('adopted_animal', 'adopters.id', 'adopted_animal.adopter_id')->leftJoin('animals', 'animals.id', 'adopted_animal.animal_id')->select('adopted_animal.adopter_id', 'adopted_animal.animal_id', 'name')->get();
        // return view('adopter.index', compact('adopters', 'adopted_animal'));

        if($request->ajax())
        {
            $data = DB::table('adopters')
            ->join('adopted_animal', 'adopted_animal.adopter_id', 'adopters.id')
            ->join('animals', 'animals.id', 'adopted_animal.animal_id')
            ->select('adopters.*','animals.name')->get();
            //dd($data);
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<a href="adopter/'.$data->id.'/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<a href="adopter/destroy/'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('adopter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animal = DB::table('animals')->leftJoin('adopted_animal', 'animals.id', 'adopted_animal.animal_id')->select('animals.id', 'name', 'status', 'animal_id')->where('status', 'adoptable')->whereNull('animal_id')->pluck('name', 'id');      
        return view('adopter.create', compact('animal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'a_fname' => 'required|min:2|max:25',
            'a_lname' => 'required|min:2|max:25',
            'date_adopted' => 'required|date_format:Y-m-d',
            'address' => 'required|min:2|max:25',
            'phone' => 'required|numeric',
            'animal_id' => 'required'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only',
            'date_format' => 'Date Format Needed.'
        ]);
        $adopter = new Adopter([
            'a_fname' => $request->get('a_fname'),
            'a_lname' => $request->get('a_lname'),
            'date_adopted' => $request->get('date_adopted'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone')
        ]);     
        $adopter->save();
        foreach ($request->animal_id as $animal_id) 
        {
            DB::table('adopted_animal')->insert(
                ['animal_id' => $animal_id,
                'adopter_id' => $adopter->id]
            );
            $animalid = Animal::find($animal_id);
            $animalid->status = 'adopted';
            $animalid->save();
        }
        return redirect()->route('adopter.index')->with('success', 'ADDED');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adopters = DB::table('adopters')->leftJoin('adopted_animal', 'adopters.id', 'adopted_animal.adopter_id')->leftJoin('animals', 'animals.id', 'adopted_animal.animal_id')->select('adopters.*', 'name', 'adopted_animal.animal_id')->where('adopters.id', $id)->get();
        $adopter = Adopter::find($id);
        $adopted_animal = DB::table('adopted_animal')->where('adopter_id', $id)->pluck('animal_id')->toArray();
        $animal = Animal::where('status', 'adoptable')->pluck('name', 'id');
        return view('adopter.edit', compact('adopter', 'id', 'animal', 'adopted_animal', 'adopters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'a_fname' => 'required|min:2|max:25',
            'a_lname' => 'required|min:2|max:25',
            'date_adopted' => 'required|date_format:Y-m-d',
            'address' => 'required|min:2|max:25',
            'phone' => 'required|numeric',
            'animal_id' => 'required'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only'
        ]);
        $adopter = Adopter::find($id);
        $adopter->a_fname = $request->get('a_fname');
        $adopter->a_lname = $request->get('a_lname');
        $adopter->date_adopted = $request->get('date_adopted');
        $adopter->address = $request->get('address');
        $adopter->phone = $request->get('phone');
        $a_id = $request->input('animal_id');
        foreach ($a_id as $animal_id) 
        {
            DB::table('adopted_animal')->where('adopter_id', $id)->delete();
        }
        foreach ($a_id as $animal_id) 
        {
            DB::table('adopted_animal')->insert(
                ['animal_id' => $animal_id, 
                'adopter_id' => $id]
            );
        }
        $adopter->save();
        if(Auth::user()->role == "adopter")
        {
            return redirect()->route('user.profile')->with('success', 'EDITED');
        }
        else
        { 
            return redirect()->route('adopter.index')->with('success', 'EDITED');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('adopted_animal')->where('adopter_id', $id)->delete();
        $adopter = Adopter::find($id);
        $adopter->delete();
        return redirect()->route('adopter.index')->with('success', 'DELETED');
    }
}
