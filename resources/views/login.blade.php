<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-6">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Login</h2>

        </div>


        <form class="space-y-4" method="post" action="{{route('login')}}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-lg font-semibold mb-3">Email Address</label>
                <input type="email" id="email" name="email"
                    class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg ">
                @error('email')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    name="password"
                    type="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                    placeholder="Enter your password">
                @error('password')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>




            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Sign in
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="text-gray-600">
                Don't have an account?
                <a href="{{route('register.show')}}" class="text-blue-600 hover:text-blue-500 font-medium">Sign up</a>
            </p>
        </div>
    </div>
</body>

</html>