@extends('layouts.staff_shell')

@section('title', 'Edit Registered Person')
@section('page_title', 'Edit Registered Person')
@section('page_subtitle', 'Update complete profile information.')

@section('body_class', 'registered-page')

@push('styles')
  @php
    $regCss = public_path('css/registered.css');
    $regVer = file_exists($regCss) ? filemtime($regCss) : time();
  @endphp
  <link rel="stylesheet" href="{{ asset('css/registered.css') }}?v={{ $regVer }}">
@endpush

@section('content')
  @include('staff.registered_edit', ['id' => $id])
@endsection