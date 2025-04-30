<div class="bg-white rounded-lg shadow-md p-4 flex flex-col md:flex-row items-center space-x-6">
    <img src="{{ asset('images/' . $image) }}" alt="{{ $title }}" class="rounded-md mb-4 md:mb-0 w-48 h-48 object-cover">
    <div class="text-left">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $title }}</h3>
        <p class="text-gray-600 text-sm">{{ $description }}</p>
    </div>
</div>
