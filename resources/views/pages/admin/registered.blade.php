@extends('layouts.admin_shell')

@section('title', 'Registered Person')
@section('page_title', 'Registered Person')
@section('page_subtitle', 'List of registered PWD profiles (local_profiles).')

@section('body_class', 'registered-page')

@push('styles')
  @php
    $regCss = public_path('css/registered.css');
    $regVer = file_exists($regCss) ? filemtime($regCss) : time();
  @endphp
  <link rel="stylesheet" href="{{ asset('css/registered.css') }}?v={{ $regVer }}">
@endpush

@section('content')
  @include('admin.registered')
@endsection