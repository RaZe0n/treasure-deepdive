@extends('layouts.layout')

@section('title', 'Edit game')

@section('content')

<form action="" method="post">
    @csrf
    @method('post')
    <button type="submit">Submit</button>
</form>

@endsection