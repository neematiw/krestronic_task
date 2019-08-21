@extends('layouts.app')

@section('content')
<div class="jumbotron"> <h2>{{$data['businessName']}}</h2>
  <hr class="my-4">
  <h4>Opening Hours:</h4> {!!$data['status']!!}
  <ul class="list-unstyled">
  @foreach ($data['openingHours'] as $val)
    <li>{{$val}}</li>
  @endforeach
</ul>
</div>
@endsection
