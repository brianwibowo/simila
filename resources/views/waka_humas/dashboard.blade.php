@extends('layouts.layout')

@section('content')
  <div class="container">
    <h1>Dashboard {{ Auth::user()->getRoleNames()->first() }}</h1>
  </div>
@endsection