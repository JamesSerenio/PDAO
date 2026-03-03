<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Staff Panel')</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}?v={{ filemtime(public_path('css/admin_dashboard.css')) }}">

  @livewireStyles
  @yield('styles')
  @stack('styles')
</head>

<body class="dash-admin staff-shell @yield('body_class')">
  <div class="dash-layout">

    <aside class="dash-sidebar">
      {{-- sidebar --}}
      <nav class="dash-nav">
        <a wire:navigate class="dash-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}" href="{{ route('staff.dashboard') }}">🏠 Dashboard</a>
        <a wire:navigate class="dash-link {{ request()->routeIs('staff.local_profile_form') ? 'active' : '' }}" href="{{ route('staff.local_profile_form') }}">🧾 Local Profile Form</a>
        <a wire:navigate class="dash-link {{ request()->routeIs('staff.mapping') ? 'active' : '' }}" href="{{ route('staff.mapping') }}">🗺️ Mapping</a>
      </nav>
    </aside>

    <main class="dash-main">
      <header class="dash-topbar">
        <div class="topbar-title">
          <h1>@yield('page_title', 'Staff Panel')</h1>
          <p>@yield('page_subtitle')</p>
        </div>
      </header>

      <section class="dash-content">
        @yield('content')
      </section>
    </main>
  </div>

  @livewireScripts
  @stack('scripts')
</body>
</html>