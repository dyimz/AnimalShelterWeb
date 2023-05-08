@extends('layouts.master')

@section('content')
    <br />
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th width="5%">BAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->role}}</td>
                    <td>
                        @if($row->status==0)
                            <a href="{{ route('user.status', $row->id) }}" class="delete btn btn-danger btn-sm">Enable</a>
                        @else
                            <a href="{{ route('user.status', $row->id) }}" class="delete btn btn-success btn-sm">Disable</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection