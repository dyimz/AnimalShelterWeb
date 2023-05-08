@extends('layouts.app')
@section('content')
  <h1>Search</h1>
    There are {{ $results->count() }} results.
    @foreach($results->groupByType() as $type => $modelSearchResults)
     <h2>{{ $type }}</h2>
      @foreach($modelSearchResults as $searchResult)
        <ul>
          <li>
            <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
          </li>
        </ul>
      @endforeach
    @endforeach
@endsection