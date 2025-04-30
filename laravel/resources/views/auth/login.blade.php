<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('/images/login.JPG');">
    <div class="bg-white bg-opacity-80 rounded-lg shadow-md p-14 w-full max-w-2xl">
        <h1 class="text-4xl font-semibold text-gray-800 mb-8 text-center">Login</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 text-lg font-bold mb-3">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email"
                       class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-gray-700 text-lg font-bold mb-3">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your Password"
                       class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-start">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-700">Remember me</label>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline w-full">
                    Login
                </button>
            </div>

        </form>
        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('password.request') }}" class="text-lg text-blue-500 hover:text-blue-700 focus:outline-none focus:shadow-outline">Forgot Password?</a>
            <a href="{{ route('register') }}" class="text-lg text-blue-500 hover:text-blue-700 focus:outline-none focus:shadow-outline">Create new account</a>
        </div>
    </div>
</body>
</html>
