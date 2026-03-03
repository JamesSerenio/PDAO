@extends('layouts.staff_shell')

@section('title', 'Local Profile Form')
@section('page_title', 'Local Profile Form')
@section('page_subtitle', 'Fill up details for local profiling.')
@section('body_class', 'lpf-page')

@push('styles')
  @php
    $cssPath = public_path('css/local_profile_form.css');
    $cssVer  = file_exists($cssPath) ? filemtime($cssPath) : time();
  @endphp
  <link rel="stylesheet" href="{{ asset('css/local_profile_form.css') }}?v={{ $cssVer }}">
@endpush

@section('content')

  {{-- ✅ This page only wraps the Livewire component --}}
  <livewire:staff.local-profile-form />

@endsection