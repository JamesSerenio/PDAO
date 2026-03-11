{{-- resources/views/pages/admin/mapping.blade.php --}}
@extends('layouts.admin_shell')

@section('title', 'admin Mapping')
@section('page_title', 'Mapping')
@section('page_subtitle', 'Search location and get coordinates')
@section('body_class', 'adminmapping')

@push('styles')
  @php
    $cssPath = public_path('css/admin_mapping.css');
    $cssVer = file_exists($cssPath) ? filemtime($cssPath) : time();
  @endphp
  <link rel="stylesheet" href="{{ asset('css/admin_mapping.css') }}?v={{ $cssVer }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

@section('content')
  <livewire:admin.mapping />
@endsection