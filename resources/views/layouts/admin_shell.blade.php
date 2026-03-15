<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- REQUIRED for Livewire requests --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Admin Panel')</title>
  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">

  {{-- Main CSS (safe filemtime) --}}
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
  ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'dashboard'],
  ['label' => 'Local Profile Form', 'route' => 'admin.local_profile_form', 'icon' => 'form'],
  ['label' => 'Mapping', 'route' => 'admin.mapping', 'icon' => 'map'],
  ['label' => 'Registered Person', 'route' => 'admin.registered', 'icon' => 'users'],
  ['label' => 'Senior Citizens', 'route' => 'admin.senior_citizens', 'icon' => 'elderly'],
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
          <a
            class="dash-link {{ $active === $item['route'] ? 'active' : '' }}"
            href="{{ route($item['route']) }}"
          >
            <span class="dash-ico">{{ $item['icon'] }}</span>
            <span>{{ $item['label'] }}</span>
          </a>
        @endforeach
      </nav>

      <div class="dash-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dash-logout" type="submit">
            <span class="dash-ico">↩️</span>
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