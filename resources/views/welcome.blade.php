<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Welcome - Laravel Project</title>
      @vite('resources/css/app.css')
      <!-- For Laravel 9/10 with Vite -->
</head>

<body class="bg-gray-100 text-gray-800">
      <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white shadow-lg rounded-2xl p-10 text-center max-w-lg w-full">
                  <h1 class="text-4xl font-bold text-blue-600 mb-4">Welcome to Laravel</h1>
                  <p class="text-gray-600 mb-6">You have successfully set up your Laravel project. Start building
                        amazing things!</p>

                  <div class="flex justify-center gap-4">
                        <a href="{{ url('/login') }}"
                              class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                              Login
                        </a>
                        <a href="{{ url('/register') }}"
                              class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                              Register
                        </a>
                  </div>

                  <div class="mt-6">
                        <a href="https://laravel.com/docs" target="_blank" class="text-blue-500 hover:underline">Laravel
                              Docs</a>
                  </div>
            </div>
      </div>
</body>

</html>