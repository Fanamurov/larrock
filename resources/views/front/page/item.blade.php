@extends('front.main')
@section('title') TEST @endsection

@section('content')
    <h1>{{ $data->title }}</h1>
    <div>{{ $data->description }}</div>
@endsection