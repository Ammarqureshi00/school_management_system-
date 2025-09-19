<!DOCTYPE html>
<html>

<head>
      <title>Reset Password</title>
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
      <div class="container" style="max-width: 500px; margin-top: 50px;">
            <h2>Reset Password</h2>

            <!-- Success message -->
            @if(session('success'))
            <div style="color: green; margin-bottom: 10px;">
                  {{ session('success') }}
            </div>
            @endif

            <!-- Error message -->
            @if($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                  {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                  @csrf
                  <input type="hidden" name="token" value="{{ $token }}">
                  <input type="hidden" name="email" value="{{ $email }}">

                  <div class="mb-3">
                        <label for="password">New Password</label>
                        <input type="password" name="password" class="form-control" required>
                  </div>

                  <div class="mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                  </div>

                  <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </form>
      </div>
</body>

</html>