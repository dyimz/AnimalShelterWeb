<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiseaseInjury;
use App\Models\ShelterPersonnel;
use App\Models\Animal;
use App\Models\Adopter;
use Auth;
use View;
use Redirect;
use DB;
use DataTables;

class DiseaseInjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $di_t = DB::table('disease_injuries')->get();
        // return view('disease_injury.index', compact('di_t'));
        if($request->ajax())
        {
            $data = DB::table('disease_injuries')->get();
            //dd($data);
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<a href="disease_injury/'.$data->id.'/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<a href="disease_injury/destroy/'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('disease_injury.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('disease_injury.create');
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
            'type' => 'required',
            'dis_inj' => 'required|min:2|max:25',
            'description' => 'required|min:2|max:25'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.'
        ]);
        $di_t = new DiseaseInjury([
            'type' => $request->get('type'),
            'dis_inj' => $request->get('dis_inj'),
            'description' => $request->get('description')
        ]); 
        $di_t->save();
        return redirect()->route('disease_injury.index')->with('success', 'ADDED');
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
        $di_t = DiseaseInjury::find($id);
        return view('disease_injury.edit', compact('di_t', 'id'));
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
            'type' => 'required',
            'dis_inj' => 'required|min:2|max:25',
            'description' => 'required|min:2|max:25'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.'
        ]);
        $di_t = DiseaseInjury::find($id);
        $di_t->type = $request->get('type');
        $di_t->dis_inj = $request->get('dis_inj');
        $di_t->description = $request->get('description');
        $di_t->save();
        return redirect()->route('disease_injury.index')->with('success', 'EDITED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $di_t = DiseaseInjury::find($id);
        $di_t->delete();
        return redirect()->route('disease_injury.index')->with('success', 'DELETED');
    }
}
