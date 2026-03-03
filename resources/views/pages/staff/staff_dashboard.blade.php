<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Staff Panel')</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">

  {{-- MAIN DASHBOARD CSS --}}
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}?v={{ filemtime(public_path('css/admin_dashboard.css')) }}">

  {{-- ✅ Livewire Styles (REQUIRED for navigate) --}}
  @livewireStyles

  {{-- ✅ 1) SUPPORT PER-PAGE CSS VIA @section('styles') --}}
  @yield('styles')

  {{-- ✅ 2) SUPPORT PER-PAGE CSS VIA @push('styles') --}}
  @stack('styles')
</head>

@php
  $menuItems = [
    ['name' => 'Dashboard','route' => 'staff.dashboard','icon' => '🏠'],
    ['name' => 'Local Profile Form','route' => 'staff.local_profile_form','icon' => '🧾'],
    ['name' => 'Mapping','route' => 'staff.mapping','icon' => '🗺️'],
  ];

  $activeRoute = request()->route() ? request()->route()->getName() : '';
@endphp

<body class="dash-admin staff-shell @yield('body_class')">

  <div class="dash-layout">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">

      <div class="dash-brand">
        <div class="brand-badge">
          <img src="{{ asset('img/LOGOP.png') }}" alt="Logo">
        </div>
        <div class="brand-text">
          <div class="brand-name">PDAO</div>
          <div class="brand-sub">Staff Panel</div>
        </div>
      </div>

      <nav class="dash-nav">
        @foreach ($menuItems as $item)
          <a
            wire:navigate
            class="dash-link {{ $activeRoute === $item['route'] ? 'active' : '' }}"
            href="{{ route($item['route']) }}"
          >
            <span class="dash-ico">{{ $item['icon'] }}</span>
            <span>{{ $item['name'] }}</span>
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

  {{-- ✅ Livewire Scripts (REQUIRED for navigate) --}}
  @livewireScripts

  {{-- ✅ Scripts --}}
  @stack('scripts')

</body>
</html>