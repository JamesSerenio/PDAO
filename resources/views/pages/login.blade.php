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
  <div class="login-container">

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

      <!-- ✅ FIXED: route name -->
      <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="login-group">
          <label>Email</label>
          <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="you@example.com"
            required>
        </div>

        <div class="login-group">
          <label>Password</label>

          <div class="password-wrapper">
            <input
              type="password"
              name="password"
              id="passwordInput"
              placeholder="••••••••"
              required>

            <span class="eye-icon" onclick="togglePassword()">
              👁
            </span>
          </div>
        </div>

        <div class="login-row">
          <label class="remember">
            <input type="checkbox" name="remember">
            Remember me
          </label>
          <span class="role-hint">Admin / Staff</span>
        </div>

        <button type="submit" class="login-btn">
          Login
        </button>
      </form>
    </div>

  </div>

  <script>
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