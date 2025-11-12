<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <form method="post" action="{{route('register')}}" class="w-full max-w-lg mx-auto bg-white p-10 rounded-xl shadow-lg">
        @csrf
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Create Account</h2>

        <div class="mb-6">
            <label for="name" class="block text-gray-700 text-lg font-semibold mb-3">Full Name</label>
            <input type="text" id="name" name="name" 
                   class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg ">
        </div>

        <div class="mb-6">
            <label for="email" class="block text-gray-700 text-lg font-semibold mb-3">Email Address</label>
            <input type="email" id="email" name="email" 
                   class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg ">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 text-lg font-semibold mb-3">Password</label>
            <input type="password" id="password" name="password" 
                   class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg">
        </div>

        <div class="mb-8">
            <label for="password_confirmation" class="block text-gray-700 text-lg font-semibold mb-3">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" 
                   class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none ">
        </div>

        <button type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg text-lg focus:outline-none focus:shadow-outline mb-6">
            Register
        </button>

        <div class="text-center">
            <p class="text-gray-600 text-lg">
                Already registered?
                <a href="/login" class="text-blue-500 hover:text-blue-700 font-semibold">Login here</a>
            </p>
        </div>
    </form>
</body>
</html>