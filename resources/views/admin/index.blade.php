@extends('layouts.layout')

@section('title', 'Admin Dashboard')

@section('content')

<h1>hallo</h1>

<form action="" method="post">
    @csrf
    @method('post')
    <input type="text" name="name" id="name">
    <button type="submit" class="bg-blue-400">Submit</button>
</form>

@endsection