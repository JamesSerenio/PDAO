@extends('layouts.admin_shell')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')

@section('page_subtitle')
  Welcome, <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})
@endsection

@push('styles')
  @php
    $pageCss = public_path('css/admin_dashboard_page.css');
    $pageCssVer = file_exists($pageCss) ? filemtime($pageCss) : time();
  @endphp
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}?v={{ $pageCssVer }}">
@endpush

@section('content')
  @livewire('admin.dashboard')
@endsection