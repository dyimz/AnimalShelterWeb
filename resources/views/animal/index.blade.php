@extends('layouts.master')
@section('content')
<div class="container pt-3 ">
<body>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Animals Table
                    <a class="btn btn-primary pull-right" type="button" href="{{ route('animal.create') }}" ><i class="fa fa-plus"></i> Animal</a>
                </h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row">
                <div class="col-md-15 col-md-offset-0">
                    <table id="animals" class="table table-bordered table-responsive table-striped" style="text-align:center">
                        <thead>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Rescuer</th>
                            <th>Date Rescued</th>
                            <th>Adopt Status</th>
                            <th>Personnel Name</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</body>
@endsection    
</html>
@section('scripts')
<script>
      $(document).ready(function()
      {
          $('#animals').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                 url: "{{ route('animal.index') }}",
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'image', name: 'image', "render": function (data, type, full, meta) { return "<img src=\"" + data + "\" height=\"100\" width=\"100\"/>";},orderable: false},
                { data: 'name', name: 'name' },
                { data: 'type', name: 'type' },
                { data: 'breed', name: 'breed' },
                { data: 'gender', name: 'gender' },
                { data: 'age', name: 'age' },
                { data: 'r_lname', name: 'r_lname' },
                { data: 'date_rescued', name: 'date_rescued' },
                { data: 'status', name: 'status' },
                { data: 'p_lname', name: 'p_lname' },
                { data: 'action', name: 'action' },
            ]
          });
      });
  </script>
  @endsection