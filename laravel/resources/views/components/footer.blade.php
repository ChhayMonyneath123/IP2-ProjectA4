<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Libre</title>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <!-- Your page content here -->

    <!-- Footer Section -->
    <footer class="bg-[#585042] text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 flex flex-col md:flex-row justify-between items-center md:items-start">

            <!-- Logo Section -->
            <div class="mb-10 md:mb-0">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/logofood_station.png') }}" alt="La Libre Logo" class="h-16 w-16 mr-4">
                    <span class="text-3xl font-semibold text-white">La Libre</span>
                </div>
                <p class="text-lg mb-6">Enjoy your meal with pleasure!</p>
                <div class="flex space-x-6">
                    <!-- Font Awesome Icons -->
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-facebook-f text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-pinterest-p text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h6 class="font-semibold text-white text-xl mb-4">Information</h6>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">About</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Product</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-semibold text-white text-xl mb-4">Company</h6>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Community</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Career</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Our story</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-semibold text-white text-xl mb-4">Contact</h6>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Getting Started</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Pricing</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white text-sm">Resources</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 mt-12 text-center text-gray-400 text-sm">
            &copy; {{ date('Y') }} La Libre. All Rights Reserved.
            <a href="#" class="hover:text-white">Terms of Use</a>
        </div>
    </footer>

</body>

</html>
