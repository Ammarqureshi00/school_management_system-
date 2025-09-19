<!doctype html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <title> Register Page</title>
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

      <div class="register-box w-100" style="max-width: 450px; height: 500px;">
            <div class="card shadow-sm rounded-3 border-0">
                  <div class="card-header text-center bg-primary text-white rounded-top">
                        <h4 class="mb-0"><i class="bi bi-mortarboard-fill"></i> School Management</h4>
                        <small>Create your account</small>
                  </div>

                  <div class="card-body p-3">
                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                              @csrf

                              <!-- Profile Picture -->
                              <div class="mb-3 text-center">
                                    <label class="form-label small d-block">Profile Picture</label>
                                    <input type="file" name="profile_pic" class="form-control form-control-sm"
                                          accept="image/*">
                                    <small class="text-muted">Upload JPG, PNG (Max: 2MB)</small>
                              </div>

                              <!-- Full Name -->
                              <div class="mb-3">
                                    <label class="form-label small">Full Name</label>
                                    <div class="input-group input-group-sm">
                                          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                          <input type="text" name="name" class="form-control"
                                                placeholder="Enter full name" required>
                                    </div>
                              </div>

                              <!-- Email -->
                              <div class="mb-3">
                                    <label class="form-label small">Email</label>
                                    <div class="input-group input-group-sm">
                                          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                          <input type="email" name="email" class="form-control"
                                                placeholder="Enter email" required>
                                    </div>
                              </div>

                              <!-- Password -->
                              <div class="mb-3">
                                    <label class="form-label small">Password</label>
                                    <div class="input-group input-group-sm">
                                          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                          <input type="password" name="password" class="form-control"
                                                placeholder="Enter password" required>
                                    </div>
                              </div>

                              <!-- Confirm Password -->
                              <div class="mb-3">
                                    <label class="form-label small">Confirm Password</label>
                                    <div class="input-group input-group-sm">
                                          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                          <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Confirm password" required>
                                    </div>
                              </div>

                              <!-- Role Selection -->
                              <div class="mb-3">
                                    <label class="form-label small">Register As</label>
                                    <select name="role" class="form-select form-select-sm" required>
                                          <option value="" disabled selected>-- Select Role --</option>
                                          <option value="teacher">👩‍🏫 Teacher</option>
                                          <option value="student">🎒 Student</option>
                                    </select>
                              </div>

                              <!-- Terms Checkbox -->
                              <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label small" for="terms">
                                          I agree to the <a href="#" class="text-primary">terms and conditions</a>
                                    </label>
                              </div>

                              <!-- Submit Button -->
                              <button type="submit" class="btn btn-primary w-100 fw-bold">
                                    <i class="bi bi-person-plus"></i> Register
                              </button>
                        </form>

                        <p class="text-center mt-3 mb-0 small">
                              Already have an account? <a href="{{ route('login') }}"
                                    class="text-decoration-none">Login</a>
                        </p>
                  </div>
            </div>
      </div>
</body>

</html>