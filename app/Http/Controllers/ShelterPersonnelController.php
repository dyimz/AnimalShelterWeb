<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShelterPersonnel;
use Auth;
use View;
use Redirect;
use DB;
use DataTables;

class ShelterPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $shelter_personnels = DB::table('shelter_personnels')->get();
        // return view('shelter_personnel.index', compact('shelter_personnels'));

        if($request->ajax())
        {
            $data = DB::table('shelter_personnels')->get();
            //dd($data);
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<a href="shelter_personnel/'.$data->id.'/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<a href="shelter_personnel/destroy/'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('shelter_personnel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shelter_personnel.create');
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
            'p_fname' => 'required|min:2|max:25',
            'p_lname' => 'required|min:2|max:25',
            'job_description' => 'required|min:2|max:25',
            'address' => 'required|min:2|max:25',
            'phone' => 'required|numeric'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only'
        ]);
        $shelter_personnel = new ShelterPersonnel([
            'p_fname' => $request->get('p_fname'),
            'p_lname' => $request->get('p_lname'),
            'job_description' => $request->get('job_description'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone')
        ]); 
        $shelter_personnel->save();
        return redirect()->route('shelter_personnel.index')->with('success', 'ADDED');
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
        $shelter_personnel = ShelterPersonnel::find($id);
        return view('shelter_personnel.edit', compact('shelter_personnel', 'id'));
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
            'p_fname' => 'required|min:2|max:25',
            'p_lname' => 'required|min:2|max:25',
            'job_description' => 'required|min:2|max:25',
            'address' => 'required|min:2|max:25',
            'phone' => 'required|numeric'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only'
        ]);
        $shelter_personnel = ShelterPersonnel::find($id);
        $shelter_personnel->p_fname = $request->get('p_fname');
        $shelter_personnel->p_lname = $request->get('p_lname');
        $shelter_personnel->job_description = $request->get('job_description');
        $shelter_personnel->address = $request->get('address');
        $shelter_personnel->phone = $request->get('phone');
        $shelter_personnel->save();
        
        if(Auth::user()->role == "employee")
        {
            return redirect()->route('shelter_personnel.index')->with('success', 'EDITED');
        }
        else
        { 
            return redirect()->route('shelter_personnel.index')->with('success', 'EDITED');
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
        $shelter_personnel = ShelterPersonnel::find($id);
        $shelter_personnel->delete();
        return redirect()->route('shelter_personnel.index')->with('success', 'DELETED');
    }
}
