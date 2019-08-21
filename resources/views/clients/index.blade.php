@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <h2>{{$client->name}}</h2>
  <hr class="my-4">
  <p><b></b>&nbsp; {{$client->business_address}}</p>
  <p><b></b>&nbsp; {{$client->phone}}</p>
  <p><b></b>&nbsp; {{$client->website_url}}</p>
  <p><b></b>&nbsp; <img src="{{$client->logo}}" alt="{{$client->name}}"/></p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="{{ route('openingHours') }}" role="button">Opening Hours >></a>
  </p>
</div>
@endsection
