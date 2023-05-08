<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Rescuer;
use App\Models\DiseaseInjury;
use App\Models\ShelterPersonnel;
use View;
use Redirect;
use DB;
use DataTables;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;
use App\Models\AnimalLog;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->ajax());
        if($request->ajax())
        {
            $data = DB::table('animals')
            ->join('rescuers', 'rescuers.id', 'animals.rescuer_id')
            ->join('shelter_personnels', 'shelter_personnels.id', 'animals.personnel_id')
            ->select('animals.*','rescuers.r_lname','shelter_personnels.p_lname',)->get();
            //dd($data);
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<a href="animal/'.$data->id.'/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<a href="animal/destroy/'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('animal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rescuer = Rescuer::pluck('r_lname', 'id');
        $disease_injury = DiseaseInjury::pluck('dis_inj', 'id');
        $personnel = ShelterPersonnel::pluck('p_lname', 'id');
        return view('animal.create', compact('rescuer', 'disease_injury', 'personnel'));
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
            'type' => 'required|min:2|max:25',
            'breed' => 'required|min:2|max:25',
            'name' => 'required|min:2|max:25',
            'gender' => 'required',
            'age' => 'required|numeric',
            'date_rescued' => 'required|date_format:Y-m-d',
            'place_rescued' => 'required|min:2|max:25',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'rescuer_id' => 'required',
            'personnel_id' => 'required',
            'date_checked' => 'required|date_format:Y-m-d'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only',
            'date_format' => 'Date Format Needed.',
            'image' => 'Image Needed.'
        ]);
        if($request->hasFile('image'))
        {
            $litrato = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $litrato);
        } 
        $animal = new Animal([
            'type' => $request->get('type'),
            'breed' => $request->get('breed'),
            'name' => $request->get('name'),
            'gender' => $request->get('gender'),
            'age' => $request->get('age'),
            'date_rescued' => $request->get('date_rescued'),
            'place_rescued' => $request->get('place_rescued'),
            'image' => 'storage/images/'.$litrato,
            'rescuer_id' => $request->get('rescuer_id'),
            'personnel_id' => $request->get('personnel_id'),
            'date_checked' => $request->get('date_checked')
        ]); 
        if (empty($request->input('disease_injury_id')))
        {
            $animal->status = 'adoptable';
            $animal->save();
        }
        else
        {
            $animal->status = 'injured';
            $animal->save();
            foreach ($request->disease_injury_id as $disease_injury_id) {
            DB::table('animal_condition')->insert(
                ['disease_injury_id' => $disease_injury_id,
                'animal_id' => $animal->id]
            );
            }
        }
        Event::dispatch(new QuoteCreated($animal));
        return redirect()->route('animal.index')->with('success', 'ADDED');
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
        $animals = DB::table('animals')->join('rescuers', 'rescuers.id', 'animals.rescuer_id')->join('shelter_personnels', 'shelter_personnels.id', 'animals.personnel_id')->leftJoin('animal_condition', 'animals.id', 'animal_condition.animal_id')->leftJoin('disease_injuries', 'disease_injuries.id', 'animal_condition.disease_injury_id')->select('animals.id', 'animals.type', 'breed', 'name', 'gender', 'age', 'date_rescued', 'place_rescued', 'image', 'r_lname', 'p_lname', 'date_checked', 'dis_inj', 'animal_condition.disease_injury_id')->where('animals.id', $id)->get();
        $animal = Animal::find($id);
        $rescuer = Rescuer::pluck('r_lname', 'id');
        $animal_condition = DB::table('animal_condition')->where('animal_id', $id)->pluck('disease_injury_id')->toArray();
        $disease_injury = DiseaseInjury::pluck('dis_inj', 'id');
        $personnel = ShelterPersonnel::pluck('p_lname', 'id');
        return view('animal.edit', compact('animal', 'id', 'rescuer', 'disease_injury', 'personnel', 'animals', 'animal_condition'));
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
            'type' => 'required|min:2|max:25',
            'breed' => 'required|min:2|max:25',
            'name' => 'required|min:2|max:25',
            'gender' => 'required',
            'age' => 'required|numeric',
            'date_rescued' => 'required|date_format:Y-m-d',
            'place_rescued' => 'required|min:2|max:25',
            'rescuer_id' => 'required',
            'personnel_id' => 'required',
            'date_checked' => 'required|date_format:Y-m-d'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only',
            'date_format' => 'Date Format Needed.'
        ]);
        $animal = Animal::find($id);
        $animal->type = $request->get('type');
        $animal->breed = $request->get('breed');
        $animal->name = $request->get('name');
        $animal->gender = $request->get('gender');
        $animal->age = $request->get('age');
        $animal->date_rescued = $request->get('date_rescued');
        $animal->place_rescued = $request->get('place_rescued');
        $animal->rescuer_id = $request->get('rescuer_id');
        $animal->personnel_id = $request->get('personnel_id');
        $animal->date_checked = $request->get('date_checked');
        $di_id = $request->input('disease_injury_id');
        if(empty($di_id))
        {
            DB::table('animal_condition')->where('animal_id', $id)->delete();
            $animal->status = 'adoptable';
        }
        else
        {
            foreach ($di_id as $disease_injury_id) 
            {
                DB::table('animal_condition')->where('animal_id', $id)->delete();
            }
            foreach ($di_id as $disease_injury_id) 
            {
                DB::table('animal_condition')->insert(['disease_injury_id' => $disease_injury_id, 'animal_id' => $id]);
            }
            $animal->status = 'injured';
        }
        $animal->save();
        return redirect()->route('animal.index')->with('success', 'EDITED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('animal_condition')->where('animal_id', $id)->delete();
        $animal = Animal::find($id);
        $animal->delete();
        return redirect()->route('animal.index')->with('success', 'DELETED');
    }

    // public function search()
    // {
    //     $word = $_GET['query'];
    //     $animals = DB::table('animals')->leftJoin('adopted_animals', 'animals.id', 'adopted_animals.animal_id')->select('animals.*')->where('status', 'Rehabilitated')->whereNull('animal_id')->where('type', 'LIKE', '%'.$word.'%')->get();
    //     return view('animal.search', compact('animals', 'word'));
    // }
}
