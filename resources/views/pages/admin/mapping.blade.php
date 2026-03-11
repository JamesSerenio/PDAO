{{-- resources/views/pages/staff/mapping.blade.php --}}
@extends('layouts.staff_shell')

@section('title', 'Staff Mapping')
@section('page_title', 'Mapping')
@section('page_subtitle', 'Search location and get coordinates')
@section('body_class', 'staffmapping')

@push('styles')
  @php
    $cssPath = public_path('css/staffmapping.css');
    $cssVer = file_exists($cssPath) ? filemtime($cssPath) : time();
  @endphp
  <link rel="stylesheet" href="{{ asset('css/admin_mapping.css.') }}?v={{ $cssVer }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

@section('content')
  <livewire:staff.mapping />
@endsection