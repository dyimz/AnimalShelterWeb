@extends('layouts.master')
@section('content')
<div class="container pt-3 ">
<body>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Animals Table
                    <a class="btn btn-primary pull-right" type="button" href="{{ route('adopter.create') }}" ><i class="fa fa-plus"></i> Adopter</a>
                </h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row">
                <div class="col-md-15 col-md-offset-0">
                    <table id="adopters" class="table table-bordered table-responsive table-striped" style="text-align:center">
                        <thead>
						<th>ID</th>
				<th>FIRST NAME</th>
				<th>LAST NAME</th>
				<th>DATE ADOPTED</th>
				<th>ADDRESS</th>
				<th>PHONE</th>
				<th>ANIMAL</th>
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
          $('#adopters').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                 url: "{{ route('adopter.index') }}",
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'a_fname', name: 'a_fname' },
                { data: 'a_lname', name: 'a_lname' },
                { data: 'date_adopted', name: 'date_adopted' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
				{ data: 'name', name: 'name' },
                { data: 'action', name: 'action' },
            ]
          });
      });
  </script>
  @endsection
