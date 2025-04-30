<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8F7F3; /* Light beige background color */
        }
        /* Pop-up success message */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            position: relative;
            margin: 15% auto;
            padding: 20px;
            background-color: white;
            width: 50%;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="flex w-full min-h-screen">
        <!-- Left side image -->
        <div class="hidden lg:block w-2/5 bg-cover bg-center" style="background-image: url('/images/register.png');"></div>

        <!-- Right side form container with bigger size -->
        <div class="w-full lg:w-3/6 bg-opacity-90 rounded-lg p-20 m-20 lg:p-16">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Create New Account</h1>
            <form id="signupForm" class="space-y-8">
                <div class="flex space-x-6">
                    <div class="flex-1">
                        <label for="first_name" class="block text-gray-700 text-lg font-semibold mb-3">First Name</label>
                        <input type="text" id="first_name" placeholder="First Name" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex-1">
                        <label for="last_name" class="block text-gray-700 text-lg font-semibold mb-3">Last Name</label>
                        <input type="text" id="last_name" placeholder="Last Name" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-gray-700 text-lg font-semibold mb-3">Email</label>
                    <input type="email" id="email" placeholder="Email" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 text-lg font-semibold mb-3">Password</label>
                    <input type="password" id="password" placeholder="Password" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button type="submit" class="bg-[#A38D64] hover:bg-[#8F7A56] text-white font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline w-full">
                    Create a new account
                </button>
            </form>
            <div class="mt-6 text-center">

            <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
            <div class="mt-8">
                <div class="flex items-center justify-center mb-6">
                    <div class="border-t border-gray-300 flex-grow mr-4"></div>
                    <span class="text-gray-500 text-lg">or</span>
                    <div class="border-t border-gray-300 flex-grow ml-4"></div>
                </div>
                <div class="flex justify-center space-x-6">
                    <!-- Google Logo -->
                    <a href="https://www.google.com" target="_blank" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline flex items-center justify-center">
                        <img src="images/google.png" alt="Google Logo" class="w-9 h-9">
                    </a>

                    <!-- Facebook Logo -->
                    <a href="https://www.facebook.com" target="_blank" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook Logo" class="w-9 h-9">
                    </a>

                    <!-- Telegram Logo -->
                    <a href="https://telegram.org" target="_blank" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram Logo" class="w-9 h-9">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Success -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h2 class="text-2xl font-semibold text-green-500">Account Created Successfully!</h2>
            <p class="text-lg text-gray-700">Welcome to our platform. You can now log in.</p>

    <a href="{{ route('login') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700" >Go to Login</a>
            <button onclick="closeModal()" class="mt-2 inline-block bg-red-500 text-white rounded-lg py-2 px-4">Close</button>
        </div>
    </div>

    <script>
        // Handle form submission
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();  // Prevent form submission to demonstrate the pop-up

            // Show the success modal
            document.getElementById('successModal').style.display = 'block';
        });

        // Close the modal
        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
        }
    </script>
</body>
</html>
