<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- REQUIRED for Livewire requests --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Admin Panel')</title>
  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">

  {{-- Main CSS --}}
  @php
    $adminCss = public_path('css/admin_dashboard.css');
    $adminVer = file_exists($adminCss) ? filemtime($adminCss) : time();
  @endphp
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}?v={{ $adminVer }}">

  {{-- Livewire Styles --}}
  @livewireStyles

  {{-- Per-page styles --}}
  @yield('styles')
  @stack('styles')
</head>

@php
  $active = request()->route() ? request()->route()->getName() : '';

  $menu = [
    ['label' => 'Dashboard',          'route' => 'admin.dashboard',          'icon' => 'dashboard'],
    ['label' => 'Local Profile Form', 'route' => 'admin.local_profile_form', 'icon' => 'form'],
    ['label' => 'Mapping',            'route' => 'admin.mapping',            'icon' => 'map'],
    ['label' => 'Registered Person',  'route' => 'admin.registered',         'icon' => 'users'],
    ['label' => 'Senior Citizens',    'route' => 'admin.senior_citizens',    'icon' => 'elderly'],
  ];
@endphp

<body class="dash-admin admin-shell @yield('body_class')">

<div class="dash-layout">

<!-- SIDEBAR -->
<aside class="dash-sidebar">

<div class="dash-brand">
  <div class="brand-badge">
    <img src="{{ asset('img/LOGOP.png') }}" alt="Logo">
  </div>
  <div class="brand-text">
    <div class="brand-name">PDAO</div>
    <div class="brand-sub">Admin Panel</div>
  </div>
</div>

<nav class="dash-nav">

@foreach($menu as $item)

<a class="dash-link {{ $active === $item['route'] ? 'active' : '' }}"
   href="{{ route($item['route']) }}">

<span class="dash-ico">

@switch($item['icon'])

@case('dashboard')
<svg width="20" height="20" viewBox="0 0 24 24" fill="black">
<path d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-6H3v6zm10-18v6h8V3h-8z"/>
</svg>
@break

@case('form')
<svg width="20" height="20" viewBox="0 0 24 24" fill="black">
<path d="M3 4h18v2H3V4zm0 5h18v2H3V9zm0 5h12v2H3v-2z"/>
</svg>
@break

@case('map')
<svg width="20" height="20" viewBox="0 0 24 24" fill="black">
<path d="M15 4l-6 2-6-2v16l6 2 6-2 6 2V6l-6-2zm0 2.18l4 1.33v12.31l-4-1.33V6.18zM9 6.18v12.31l-4-1.33V4.85l4 1.33z"/>
</svg>
@break

@case('users')
<svg width="20" height="20" viewBox="0 0 24 24" fill="black">
<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.67 0-8 1.34-8 4v2h10v-2c0-2.66-5.33-4-8-4zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.98 1.97 3.45v2H24v-2c0-2.66-5.33-4-8-4z"/>
</svg>
@break

@case('elderly')
<svg width="20" height="20" viewBox="0 0 24 24" fill="black">
<path d="M12 2a3 3 0 110 6 3 3 0 010-6zm-1 7h2v4h3v2h-3v7h-2v-7H8v-2h3V9z"/>
</svg>
@break

@endswitch

</span>

<span>{{ $item['label'] }}</span>

</a>

@endforeach

</nav>

<div class="dash-sidebar-footer">
<form method="POST" action="{{ route('logout') }}">
@csrf

<button class="dash-logout" type="submit">
<span class="dash-ico">

<svg width="20" height="20" viewBox="0 0 24 24" fill="black">
<path d="M10 17l5-5-5-5v10zM19 3H5c-1.1 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
</svg>

</span>
Logout
</button>

</form>
</div>

</aside>

<!-- MAIN -->
<main class="dash-main">

<header class="dash-topbar">

<div class="topbar-title">
<h1>@yield('page_title', 'Admin Panel')</h1>
<p>@yield('page_subtitle')</p>
</div>

<div class="topbar-right">
<div class="topbar-chip">
<span class="chip-dot"></span>
Logged in
</div>
</div>

</header>

<section class="dash-content">
@yield('content')
</section>

</main>

</div>

{{-- Livewire Scripts --}}
@livewireScripts

{{-- Per-page scripts --}}
@stack('scripts')

</body>
</html>