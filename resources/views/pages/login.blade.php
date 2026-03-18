<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDAO | Login</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body class="login">
  <div class="login-stage" id="loginStage">

    <!-- background image -->
    <div class="login-bg"></div>
    <div class="login-overlay"></div>

    <!-- top logos -->
    <div class="top-brand" id="topBrand">
      <div class="top-logo left">
        <img src="{{ asset('img/LOGOL.png') }}" alt="Left Logo">
      </div>

      <div class="top-logo right">
        <img src="{{ asset('img/LOGOP.png') }}" alt="Right Logo">
      </div>
    </div>

    <!-- main card -->
    <div class="login-shell intro-mode" id="loginShell">

      <!-- intro screen -->
      <div class="intro-panel" id="introPanel">
        <h1 class="intro-title">Login</h1>
        <p class="intro-subtitle">Provincial Persons with Disability Affairs Office</p>

        <button type="button" class="intro-btn" id="showFormBtn">
          Login
        </button>
      </div>

      <!-- form screen -->
      <div class="form-panel" id="formPanel">
        <div class="login-card">

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
              <label>Email</label>
              <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                required>
            </div>

            <div class="login-group field field-2">
              <label>Password</label>

              <div class="password-wrapper">
                <input
                  type="password"
                  name="password"
                  id="passwordInput"
                  placeholder="••••••••"
                  required>

                <span class="eye-icon" onclick="togglePassword()">👁</span>
              </div>
            </div>

            <div class="login-row field field-3">
              <label class="remember">
                <input type="checkbox" name="remember">
                Remember me
              </label>

              <span class="role-hint">Admin</span>
            </div>

            <button type="submit" class="login-btn field field-4">
              Login
            </button>

            <button type="button" class="back-btn" id="backBtn">
              Back
            </button>
          </form>

        </div>
      </div>

    </div>
  </div>

  <script>
    const loginStage = document.getElementById('loginStage');
    const loginShell = document.getElementById('loginShell');
    const showFormBtn = document.getElementById('showFormBtn');
    const backBtn = document.getElementById('backBtn');

    showFormBtn.addEventListener('click', function () {
      loginStage.classList.add('form-open');
      loginShell.classList.remove('intro-mode');
      loginShell.classList.add('form-mode');
    });

    backBtn.addEventListener('click', function () {
      loginStage.classList.remove('form-open');
      loginShell.classList.remove('form-mode');
      loginShell.classList.add('intro-mode');
    });

    function togglePassword() {
      const input = document.getElementById("passwordInput");
      const icon = document.querySelector(".eye-icon");

      if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈";
      } else {
        input.type = "password";
        icon.textContent = "👁";
      }
    }
  </script>
</body>
</html>