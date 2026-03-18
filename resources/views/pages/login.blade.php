<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDAO | Login</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="login" data-has-errors="{{ $errors->any() ? '1' : '0' }}">
  <div class="scene" id="scene">

    <div class="scene-bg"></div>
    <div class="scene-overlay"></div>
    <div class="bg-to-card"></div>

    <div class="travel-badge travel-left">
      <img src="{{ asset('img/LOGOL.png') }}" alt="Left Logo">
    </div>

    <div class="travel-badge travel-right">
      <img src="{{ asset('img/LOGOP.png') }}" alt="Right Logo">
    </div>

    <section class="intro-screen">
      <div class="intro-panel">
        <h1 class="intro-title">Login</h1>
        <p class="intro-subtitle">Manolo Fortich Person With Disabilities Affairs Office</p>
        <button type="button" class="intro-btn" id="openLoginBtn">Login</button>
      </div>
    </section>

    <section class="form-screen">
      <div class="login-card">
        <div class="card-bg"></div>
        <div class="card-overlay"></div>

        <div class="login-header">
          <div class="logo-left">
            <img src="{{ asset('img/LOGOL.png') }}" alt="Left Logo">
          </div>

          <h1>Login</h1>

          <div class="logo-right">
            <img src="{{ asset('img/LOGOP.png') }}" alt="Right Logo">
          </div>
        </div>

        @if ($errors->any())
          <div class="login-alert">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="login-form">
          @csrf

          <div class="login-group field field-1">
            <label for="email">Email</label>
            <input
              id="email"
              type="email"
              name="email"
              value="{{ old('email') }}"
              placeholder="you@example.com"
              required>
          </div>

          <div class="login-group field field-2">
            <label for="passwordInput">Password</label>
            <div class="password-wrapper">
              <input
                id="passwordInput"
                type="password"
                name="password"
                placeholder="••••••••"
                required>
              <button type="button" class="eye-icon" id="togglePasswordBtn" aria-label="Toggle password visibility">👁</button>
            </div>
          </div>

          <div class="login-row field field-3">
            <label class="remember">
              <input type="checkbox" name="remember">
              Remember me
            </label>
            <span class="role-hint">Admin</span>
          </div>

          <button type="submit" class="login-btn field field-4">Login</button>
          <button type="button" class="back-btn field field-5" id="backBtn">Back</button>
        </form>
      </div>
    </section>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const scene = document.getElementById('scene');
      const openLoginBtn = document.getElementById('openLoginBtn');
      const backBtn = document.getElementById('backBtn');
      const passwordInput = document.getElementById('passwordInput');
      const togglePasswordBtn = document.getElementById('togglePasswordBtn');
      const hasErrors = document.body.dataset.hasErrors === '1';

      function openForm() {
        scene.classList.add('show-form');
      }

      function closeForm() {
        scene.classList.remove('show-form');
      }

      function togglePassword() {
        if (!passwordInput || !togglePasswordBtn) return;

        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          togglePasswordBtn.textContent = '🙈';
        } else {
          passwordInput.type = 'password';
          togglePasswordBtn.textContent = '👁';
        }
      }

      if (openLoginBtn) openLoginBtn.addEventListener('click', openForm);
      if (backBtn) backBtn.addEventListener('click', closeForm);
      if (togglePasswordBtn) togglePasswordBtn.addEventListener('click', togglePassword);

      if (hasErrors) {
        scene.classList.add('show-form');
      }
    });
  </script>
</body>
</html>