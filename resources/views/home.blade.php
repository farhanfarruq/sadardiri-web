@extends('layouts.app')

@section('content')
    <h1>Selamat datang di Dashboard</h1>
    <p>Halo, {{ Auth::user()->name }}! 🎉</p>
@endsection
