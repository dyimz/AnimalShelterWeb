@extends('layouts.master')
@section('content')
<div class="container pt-3 ">
<body>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Animals Table
                    <a class="btn btn-primary pull-right" type="button" href="{{ route('rescuer.create') }}" ><i class="fa fa-plus"></i> Rescuer</a>
                </h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row">
                <div class="col-md-15 col-md-offset-0">
                    <table id="rescuers" class="table table-bordered table-responsive table-striped" style="text-align:center">
                        <thead>
						<th>ID</th>
						<th>FIRST NAME</th>
				<th>LAST NAME</th>
				<th>ADDRESS</th>
				<th>PHONE</th>
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
          $('#rescuers').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                 url: "{{ route('rescuer.index') }}",
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'r_fname', name: 'r_fname' },
                { data: 'r_lname', name: 'r_lname' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { data: 'action', name: 'action' },
            ]
          });
      });
  </script>
  @endsection