<!-- made by East Coders -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('_partials._head')
</head>

@extends('pageLayouts.auth')

@section('content')

    @include('_partials._loginForm')

@endsection