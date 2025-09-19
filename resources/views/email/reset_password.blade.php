<!DOCTYPE html>
<html>

<head>
      <title>Reset Password</title>
</head>

<body>
      <h2>Hello, {{ $user->name }}</h2>
      <p>You requested to reset your password. Click the link below:</p>
      <a href="{{ $url }}">Reset Password</a>
</body>

</html>