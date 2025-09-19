<!doctype html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <title>AdminLTE 4 | Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- CSS -->
      <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
            crossorigin="anonymous">
      <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
            crossorigin="anonymous">
</head>

<body class="d-flex align-items-center justify-content-center vh-100" style="background-color: #f4f6f9;">

      <div class="login-box w-100" style="max-width: 380px;">
            <div class="card shadow-sm rounded-3 border-0">
                  <!-- Header -->
                  <div class="card-header text-center bg-primary text-white rounded-top">
                        <h4 class="mb-0"><i class="bi bi-person-circle"></i> Login</h4>
                        <small>Access your account</small>
                  </div>

                  <!-- Body -->
                  <div class="card-body p-3">
                        <form action="{{ route('login') }}" method="POST">
                              @csrf

                              <!-- Email -->
                              <div class="mb-3">
                                    <label class="form-label small">Email</label>
                                    <div class="input-group input-group-sm">
                                          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                          <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="Enter email" required autofocus>
                                    </div>
                                    @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                              </div>

                              <!-- Password -->
                              <div class="mb-3">
                                    <label class="form-label small">Password</label>
                                    <div class="input-group input-group-sm">
                                          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                          <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Enter password" required>
                                    </div>
                                    @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                              </div>

                              <!-- Remember Me -->
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                          <label class="form-check-label small" for="remember">Remember Me</label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot
                                          Password?</a>
                              </div>

                              <!-- Submit Button -->
                              <button type="submit" class="btn btn-primary w-100 fw-bold">
                                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                              </button>
                        </form>

                        <!-- Footer Links -->
                        <p class="text-center mt-3 mb-0 small">
                              Don’t have an account? <a href="{{ route('register') }}"
                                    class="text-decoration-none">Register</a>
                        </p>
                  </div>
            </div>
      </div>
</body>

</html>