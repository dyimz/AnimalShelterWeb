@extends('layouts.master')
@section('content')
<div class="container pt-3 ">
<body>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Animals Table
                    <a class="btn btn-primary pull-right" type="button" href="{{ route('disease_injury.create') }}" ><i class="fa fa-plus"></i> Dis/Inj</a>
                </h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row">
                <div class="col-md-15 col-md-offset-0">
                    <table id="disease_injuries" class="table table-bordered table-responsive table-striped" style="text-align:center">
                        <thead>
						<<th>ID</th>
				<th>TYPE</th>
				<th>NAME</th>
				<th>DESCRIPTION</th>
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
          $('#disease_injuries').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                 url: "{{ route('disease_injury.index') }}",
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'type', name: 'type' },
                { data: 'dis_inj', name: 'dis_inj' },
				{ data: 'description', name: 'description' },
                { data: 'action', name: 'action' },
            ]
          });
      });
  </script>
  @endsection