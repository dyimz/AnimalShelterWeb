<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescuer;
use Auth;
use View;
use Redirect;
use DB;
use DataTables;

class RescuerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $rescuers = DB::table('rescuers')->get();
        // return view('rescuer.index', compact('rescuers'));

        if($request->ajax())
        {
            $data = DB::table('rescuers')->get();
            //dd($data);
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<a href="rescuer/'.$data->id.'/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<a href="rescuer/destroy/'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('rescuer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rescuer.create');
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
            'r_fname' => 'required|min:2|max:25',
            'r_lname' => 'required|min:2|max:25',
            'address' => 'required|min:2|max:25',
            'phone' => 'required|numeric'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only'
        ]);
        $rescuer = new Rescuer([
            'r_fname' => $request->get('r_fname'),
            'r_lname' => $request->get('r_lname'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone')
        ]); 
        $rescuer->save();
        return redirect()->route('rescuer.index')->with('success', 'ADDED');
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
        $rescuer = Rescuer::find($id);
        return view('rescuer.edit', compact('rescuer', 'id'));
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
            'r_fname' => 'required|min:2|max:25',
            'r_lname' => 'required|min:2|max:25',
            'address' => 'required|min:2|max:25',
            'phone' => 'required|numeric'
        ],[
            'required' => 'Need Input.',
            'min' => 'Input too short.',
            'max' => 'Input too long.',
            'numeric' => 'Input Number only'
        ]);
        $rescuer = Rescuer::find($id);
        $rescuer->r_fname = $request->get('r_fname');
        $rescuer->r_lname = $request->get('r_lname');
        $rescuer->address = $request->get('address');
        $rescuer->phone = $request->get('phone');
        $rescuer->save();
        if(Auth::user()->role == "rescuer")
        {
            return redirect()->route('user.profile')->with('success', 'EDITED');
        }
        else
        { 
            return redirect()->route('rescuer.index')->with('success', 'EDITED');
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
        $rescuer = Rescuer::find($id);
        $rescuer->delete();
        return redirect()->route('rescuer.index')->with('success', 'DELETED');
    }
}
