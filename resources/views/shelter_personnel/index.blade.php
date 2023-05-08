@extends('layouts.master')
@section('content')
<div class="container pt-3 ">
<body>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Animals Table
                    <a class="btn btn-primary pull-right" type="button" href="{{ route('shelter_personnel.create') }}" ><i class="fa fa-plus"></i> Personnel</a>
                </h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row">
                <div class="col-md-15 col-md-offset-0">
                    <table id="shelter_personnels" class="table table-bordered table-responsive table-striped" style="text-align:center">
                        <thead>
						<th>ID</th>
				<th>FIRST NAME</th>
				<th>LAST NAME</th>
				<th>JOB DESCRIPTION</th>
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
          $('#shelter_personnels').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                 url: "{{ route('shelter_personnel.index') }}",
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'p_fname', name: 'p_fname' },
                { data: 'p_lname', name: 'p_lname' },
				{ data: 'job_description', name: 'job_description' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { data: 'action', name: 'action' },
            ]
          });
      });
  </script>
  @endsection