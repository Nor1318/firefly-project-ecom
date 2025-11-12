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
        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Login</h2>
           
        </div>

      
        <form class="space-y-4">
           
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter your password"
                    required
                >
            </div>

           

          
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200"
            >
                Sign in
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="text-gray-600">
                Don't have an account?
                <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Sign up</a>
            </p>
        </div>
    </div>
</body>
</html>