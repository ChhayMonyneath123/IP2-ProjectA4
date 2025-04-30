<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Libre</title>
    <!-- Include Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS CDN (If you're using Tailwind for styling) -->
    <script src="https://cdn.tailwindcss.com"></script>
    

</head>
<body>
    
    <nav class="w-full bg-[#F8F7F3] shadow-md font-['IBM_Plex_Sans_Condensed']">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between flex-nowrap px-6 py-4 space-x-6 overflow-x-auto">

            <!-- Logo Section -->
            <div class="flex items-center gap-4 shrink-0">
                <img src="{{ asset('images/logofood_station.png') }}" alt="La Libre Logo" class="h-20">
                <span class="text-3xl font-bold whitespace-nowrap">La Libre</span>
            </div>

            <!-- Nav Links -->
            <ul class="hidden lg:flex gap-10 items-center text-xl text-gray-700 shrink-0">
                <li><a href="#" class="hover:text-orange-500 transition">Home</a></li>
                <li><a href="#" class="hover:text-orange-500 transition">Menu</a></li>
                <li><a href="#" class="hover:text-orange-500 transition">Contact</a></li>
                <li><a href="#" class="hover:text-orange-500 transition">About US</a></li>
            </ul>

            <!-- Search Bar -->
            <div class="hidden lg:flex items-center bg-[#f0efeb] rounded-full px-5 py-2 shrink-0">
                <input type="text" placeholder="Searching..." class="bg-transparent outline-none w-80 placeholder:text-base text-base">
                <img src="{{ asset('images/search.png') }}" alt="Search" class="w-5 h-5 ml-3">
            </div>

            <!-- Icons & Logout -->
            <div class="flex items-center gap-5 shrink-0">
                <img src="{{ asset('images/cart.png') }}" alt="Cart" class="w-7 h-7 cursor-pointer">
                <img src="{{ asset('images/wishlist.png') }}" alt="Wishlist" class="w-7 h-7 cursor-pointer">
                <img src="{{ asset('images/menu.png') }}" alt="Menu" class="w-6 h-6 cursor-pointer lg:hidden">

                <!-- Logout Button -->
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
            </div>
        </div>
    </nav>


        <section class="bg-cover bg-center py-16 md:py-24" style="background-image: url('/images/bg.png');">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
                <div class="md:w-1/2 text-center md:text-left mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Tasty Food & Refreshing Drinks, Delivered Fast!</h1>
                    <p class="text-white mb-6">Satisfy your cravings with an extensive menu of delicious meals from top restaurants, all delivered hot and fresh to your doorstep. Whether you're in the mood for comfort food or something new, we offer a wide variety of options to suit every taste. Enjoy a seamless ordering experience with fast delivery, easy payments, and unbeatable flavors - everything you need, all in one place!</p>
                    {{-- <a href="{{ route('product.index') }}">
                        <button class="bg-white hover:bg-brown text-black font-semibold py-3 px-6 rounded-md transition duration-300">Shop Now</button>
                    </a> --}}
                    </div>
                <div class="md:w-1/2 flex justify-between space-x-4 relative">
                    <img src="{{ asset('images/sushi.png') }}" alt="Food Delivery" class="pt-5 w-full md:w-auto">
                    <img src="{{ asset('images/mango_cake.png') }}" alt="Food Delivery 2" class="rounded-r-lg shadow-lg w-full md:w-auto absolute top-8 right-0">
                </div>
            </div>
        </section>

        <section class="py-16">
            <div class="container mx-auto text-center px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Our Menu</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <div class="p-4">
                        <img src="{{ asset('images/food.png') }}" alt="Food Delivery" class="pt-5 w-full h-96 object-cover rounded-md">
                        <h3 class="text-xl font-semibold text-gray-800">Food</h3>
                    </div>
                    <div class="p-4">
                        <img src="{{ asset('images/cafe.jpg') }}" alt="Food Delivery" class="pt-5 w-full h-96 object-cover rounded-md">
                        <h3 class="text-xl font-semibold text-gray-800">Beverage2</h3>
                    </div>
                    <div class="p-4">
                        <img src="{{ asset('images/cake.png') }}" alt="Food Delivery" class="pt-5 w-full h-96 object-cover rounded-md">
                        <h3 class="text-xl font-semibold text-gray-800">Cake</h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16">
            <div class="container mx-auto text-center px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Popular Menu</h2>
                <div class="relative">
                    <div id="popular-menu-items" class="flex flex-row gap-8 items-center justify-center overflow-x-auto scrollbar-hide">
                        <x-menu-item image="{{ asset('images/sushi.png') }}" title="Sushi" description="Fresh and delicious sushi rolls." />
                        <x-menu-item image="{{ asset('images/mango_cake.png') }}" title="Mango Shake" description="Refreshing mango shake." />
                        <x-menu-item image="{{ asset('images/amok1.png') }}" title="Sushi" description="Assorted sushi platter." />
                        <x-menu-item image="{{ asset('images/red_cake.png') }}" title="Chicken Dish" description="Spicy grilled chicken with vegetables." />
                        <x-menu-item image="{{ asset('images/green_tea.png') }}" title="Sushi" description="Fresh and delicious sushi rolls." />
                        <x-menu-item image="{{ asset('images/food.png') }}" title="Mango Shake" description="Refreshing mango shake." />

                    </div>


                    <!-- Left Scroll Arrow -->
                    <button id="scroll-left" class="absolute left-[-40px] top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md cursor-pointer" aria-label="Scroll Left">
                        <i class="fas fa-arrow-left"></i> <!-- Font Awesome left arrow icon -->
                    </button>

                    <!-- Right Scroll Arrow -->
                    <button id="scroll-right" class="absolute right-[-40px] top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md cursor-pointer" aria-label="Scroll Right">
                        <i class="fas fa-arrow-right"></i> <!-- Font Awesome right arrow icon -->
                    </button>
                </div>
            </div>
        </section>
    </div>

<section class="py-16 ">
    <div class="container mx-auto text-center px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Explore Our New Menu Every Day</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- Use the FoodItem Component -->
            <x-food-item image="green_tea.png" title="Iced Latte" description="A refreshing cold drink made with espresso and milk" />
            <x-food-item image="fish_sushi.png" title="Sushi" description="Fresh and delicious sushi rolls" />
            <x-food-item image="red_cake.png" title="Cake" description="Yummy cake with creamy frosting" />
            <x-food-item image="mango_cake.png" title="Mango Shake" description="A refreshing tropical drink made with ripe mangoes" />

            <!-- Hidden additional items -->
            <div class="food-item hidden">
                <x-food-item image="cake.png" title="Burger" description="Juicy beef patty with fresh toppings" />
            </div>
            <div class="food-item hidden">
                <x-food-item image="amok1.png" title="Pizza" description="Delicious pizza with melted cheese" />
            </div>
        </div>
         <!-- View More Button -->
         <div class="flex justify-center mt-8">
            <button id="viewMoreBtn" class="bg-black
             hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-md transition duration-300">View More</button>
        </div>

</section>
<section class="py-16 px-8" style="background-color: #A1998A;">
    <div class="container mx-auto text-center px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">How it works</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
        <div>
            <i class="fas fa-utensils text-white text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Pick Meals</h3>
            <p class="text-gray-600 text-sm">Choose your favorite meals from our diverse menu.</p>
        </div>
        <div>
            <i class="fas fa-credit-card text-white text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Choose Payment</h3>
            <p class="text-gray-600 text-sm">Select your preferred payment method.</p>
        </div>
        <div>
            <i class="fas fa-map-pin text-white text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Select Address</h3>
            <p class="text-gray-600 text-sm">Enter your delivery address.</p>
        </div>
        <div>
            <i class="fas fa-truck text-white text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Fast Delivery</h3>
            <p class="text-gray-600 text-sm">Your order will be delivered quickly.</p>
        </div>
        <div>
            <i class="fas fa-smile text-white text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Enjoy your order</h3>
            <p class="text-gray-600 text-sm">Savor your delicious meal!</p>
        </div>
    </div>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="rounded-lg py-10 px-6 text-center flex flex-col items-center justify-center w-[1080px] h-[300px] mx-auto"
        style="background-image: url('/images/promotion.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">

            <h2 class="text-2xl font-bold text-white mb-4">Subscribe To Us and Get 50% Discount</h2>
            <div class="flex flex-col sm:flex-row w-full max-w-md mx-auto">
                <input type="email" placeholder="Enter your Email" class="border border-gray-700 rounded-md px-4 py-2 mb-3 sm:mb-0 sm:mr-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-md transition duration-300 w-full sm:w-auto">Sign In</button>
            </div>
        </div>
    </div>
</section>
<section class="py-16">
    <div class="container mx-auto text-center px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

        <!-- Left Side (Features Grid) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

          <!-- Item -->
          <div class="flex flex-col items-center p-6 border rounded-lg bg-coffee h-full text-center">
            <i class="fas fa-truck text-brown text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Fast Delivery</h3>
            <p class="text-gray-600 text-sm">Enjoy your favorite dishes and drinks, delivered hot and fresh to your door, quickly and hassle-free.</p>
          </div>

          <!-- Item -->
          <div class="flex flex-col items-center p-6 border rounded-lg bg-white h-full text-center">
            <i class="fas fa-lemon text-brown text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Premium Ingredients</h3>
            <p class="text-gray-600 text-sm">We use only the finest, freshest ingredients to ensure every meal and drink is delicious and satisfying.</p>
          </div>

          <!-- Item -->
          <div class="flex flex-col items-center p-6 border rounded-lg bg-white h-full text-center">
            <i class="fas fa-concierge-bell text-brown text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Diverse Menu</h3>
            <p class="text-gray-600 text-sm">From mouthwatering meals to refreshing drinks, we offer a wide variety to satisfy every craving.</p>
          </div>

          <!-- Item -->
          <div class="flex flex-col items-center p-6 border rounded-lg bg-white h-full text-center">
            <i class="fas fa-heart text-brown text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Super Taste</h3>
            <p class="text-gray-600 text-sm">Rich, bold, and unforgettable flavors in every dish or sip, offering a truly enjoyable and satisfying experience.</p>
          </div>
        </div>

        <!-- Right Side (Text Content) -->
        <div class="text-gray-700 text-center md:text-left mt-8 mb-8">
          <h1 class="text-3xl font-bold text-gray-800 my-10 text-center">Why should you choose us?</h1>
          <p class="text-l leading-relaxed my-10">Choose our restaurant for a premium dining experience with the finest ingredients, expertly prepared to deliver rich, delicious flavors. We offer a diverse menu of mouthwatering meals and refreshing drinks, all crafted to satisfy your cravings. Enjoy fast, reliable delivery, bringing your favorite dishes straight to your door, hot and fresh. Whether you're craving comfort food or a specialty drink, we’ve got you covered with convenience and exceptional taste, every time!</p>
        </div>

      </div>
    </div>
  </section>


  <x-footer />


<script>
    document.getElementById('viewMoreBtn').addEventListener('click', function() {
        // Reveal hidden items
        const hiddenItems = document.querySelectorAll('.food-item.hidden');
        hiddenItems.forEach(item => item.classList.remove('hidden'));

        // Hide the "View More" button after it is clicked
        this.style.display = 'none';
    });
        const hamburgerBtn = document.getElementById("hamburger-btn");
        const mobileMenu = document.getElementById("mobile-menu");
        const closeMenuBtn = document.getElementById("close-menu-btn");
        const mobileMenuLinks = mobileMenu.querySelectorAll("a");
        const navLinks = document.querySelectorAll('.nav-links a');


        function toggleMobileMenu() {
            mobileMenu.classList.toggle("hidden");
        }

        hamburgerBtn.addEventListener("click", toggleMobileMenu);
        closeMenuBtn.addEventListener("click", toggleMobileMenu);
        mobileMenuLinks.forEach(link => {
            link.addEventListener("click", toggleMobileMenu);
        });

        document.addEventListener('click', (event) => {
            if (!mobileMenu.classList.contains('hidden') && !mobileMenu.contains(event.target) && event.target !== hamburgerBtn) {
                toggleMobileMenu();
            }
        });
    </script>


<script>
    // Get the menu items container and scroll buttons
    const menuItems = document.getElementById('popular-menu-items');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');

    // Calculate the width of one item
    const itemWidth = menuItems.children[0].offsetWidth + 16; // 16px for gap between items

    // Scroll Left functionality
    scrollLeftBtn.addEventListener('click', () => {
        menuItems.scrollLeft -= itemWidth; // Scroll by one item width
    });

    // Scroll Right functionality
    scrollRightBtn.addEventListener('click', () => {
        menuItems.scrollLeft += itemWidth; // Scroll by one item width
    });
    </script>
</body>
</html>
