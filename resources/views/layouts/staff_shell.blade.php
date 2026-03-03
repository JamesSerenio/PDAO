<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Staff Panel')</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">

  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}?v={{ filemtime(public_path('css/admin_dashboard.css')) }}">

  {{-- Livewire v4 --}}
  @livewireStyles

  {{-- Per-page styles --}}
  @yield('styles')
  @stack('styles')
</head>

@php
  $active = request()->route() ? request()->route()->getName() : '';

  $menu = [
    ['label' => 'Dashboard',          'route' => 'staff.dashboard',          'icon' => '🏠'],
    ['label' => 'Local Profile Form', 'route' => 'staff.local_profile_form', 'icon' => '🧾'],
    ['label' => 'Mapping',            'route' => 'staff.mapping',            'icon' => '🗺️'],
  ];
@endphp

<body class="dash-admin staff-shell @yield('body_class')">
  <div class="dash-layout">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">

      <!-- Brand -->
      <div class="dash-brand">
        <div class="brand-badge">
          <img src="{{ asset('img/LOGOP.png') }}" alt="Logo">
        </div>
        <div class="brand-text">
          <div class="brand-name">PDAO</div>
          <div class="brand-sub">Staff Panel</div>
        </div>
      </div>

      <!-- Nav -->
      <nav class="dash-nav">
        @foreach($menu as $item)
          <a
            wire:navigate
            class="dash-link {{ $active === $item['route'] ? 'active' : '' }}"
            href="{{ route($item['route']) }}"
          >
            <span class="dash-ico">{{ $item['icon'] }}</span>
            <span>{{ $item['label'] }}</span>
          </a>
        @endforeach
      </nav>

      <!-- Footer -->
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
          <h1>@yield('page_title', 'Staff Panel')</h1>
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

  {{-- Livewire v4 --}}
  @livewireScripts

  {{-- Per-page scripts --}}
  @stack('scripts')
</body>
</html>