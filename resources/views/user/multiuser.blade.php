@extends('layouts.master')
@section('title', 'Profile')
@section('content')
    @if(Auth::user()->role == "admin")
    <table class="table table-sm" id="laravel_crud">
        @if($message = Session::get('success'))
            <div class="msg">
                <p>{{$message}}</p>
            </div>
        @endif
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th colspan="4">EDIT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->role}}</td>
                    <td><a href="{{route('admin.edit', $admin->id)}}" class="tbtn"><i class="fa fa-pencil"></i></a></td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div  class="col-sm-6 col-md-6">
                @if(empty($adoptedChart))
                    <div></div>
                @else
                    <div>{!! $adoptedChart->container() !!}</div>
                    {!! $adoptedChart->script() !!}
                @endif   
            </div>
            <div  class="col-sm-6 col-md-6">
                @if(empty($rescuedChart))
                    <div></div>
                @else
                    <div>{!! $rescuedChart->container() !!}</div>
                    {!! $rescuedChart->script() !!}
                @endif   
            </div>
        </div>
        <div class="row">
            @if(empty($rescuedChart))
                    <div></div>
            @else
                <div>{!! $clinicChart->container() !!}</div>
                {!! $clinicChart->script() !!}
            @endif  
        </div>
    @else
    <table class="table table-sm" id="laravel_crud">
            @if($message = Session::get('success'))
                <div class="msg">
                    <p>{{$message}}</p>
                </div>
            @endif
            @if(Auth::user()->role == "employee")
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>JOB DESCRIPTION</th>
                        <th>ADDRESS</th>
                        <th>PHONE</th>
                        <th>USER ID</th>
                        <th colspan="7">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$profile->id}}</td>
                        <td>{{$profile->p_fname}}</td>
                        <td>{{$profile->p_lname}}</td>
                        <td>{{$profile->job_description}}</td>
                        <td>{{$profile->address}}</td>
                        <td>{{$profile->phone}}</td>
                        <td>{{$profile->user_id}}</td>
                        <td><a href="{{route('shelter_personnel.edit', $profile->id)}}" class="tbtn"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                </tbody>    
            @elseif(Auth::user()->role == "rescuer")
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>ADDRESS</th>
                        <th>PHONE</th>
                        <th>USER ID</th>
                        <th colspan="6">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$profile->id}}</td>
                        <td>{{$profile->r_fname}}</td>
                        <td>{{$profile->r_lname}}</td>
                        <td>{{$profile->address}}</td>
                        <td>{{$profile->phone}}</td>
                        <td>{{$profile->user_id}}</td>
                        <td><a href="{{route('rescuer.edit', $profile->id)}}" class="tbtn"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                </tbody>
            @elseif(Auth::user()->role == "adopter")
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>DATE ADOPTED</th>
                        <th>ADDRESS</th>
                        <th>PHONE</th>
                        <th>USER ID</th>
                        <th colspan="7">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$profile->id}}</td>
                        <td>{{$profile->a_fname}}</td>
                        <td>{{$profile->a_lname}}</td>
                        <td>{{$profile->date_adopted}}</td>
                        <td>{{$profile->address}}</td>
                        <td>{{$profile->phone}}</td>
                        <td>{{$profile->user_id}}</td>
                        <td><a href="{{route('adopter.edit', $profile->id)}}" class="tbtn"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                </tbody>    
            @endif
        </table>
        <table class="table table-sm" id="laravel_crud">
            <thead>
                <tr>
                    <th>TYPE</th>
                    <th>BREED</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>AGE</th>
                    <th>RESCUED</th>
                    <th>PLACE</th>
                    <th>IMAGE</th>
                    <th>CHECKED</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>     
                @foreach($query as $row)
                <tr>
                    <td>{{$row->type}}</td>
                    <td>{{$row->breed}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->gender}}</td>
                    <td>{{$row->age}}</td>
                    <td>{{$row->date_rescued}}</td>
                    <td>{{$row->place_rescued}}</td>
                    <td><img src="{{ asset($row->image) }}" width="100px" height="100px"></td>
                    <td>{{$row->date_checked}}</td>
                    <td>{{$row->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection