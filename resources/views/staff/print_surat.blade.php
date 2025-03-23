@extends('components.layout')

@section('title')
    Home
@endsection

@section('content')
<body>
    <div class="bg-gray-800 text-white rounded-lg p-6 mt-10 shadow-md max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-3">
                <h3 class="text-lg font-semibold">
                    Order ID: <a href="#" class="text-blue-400 hover:underline">#FWB1273756</a>
                </h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500 text-white">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Completed
                </span>
            </div>
            <div class="flex space-x-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Order again
                </button>
                <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Order details
                </button>
            </div>
        </div>
    
        <!-- Download Invoice Link -->
        <div class="mb-4">
            <a href="#" class="text-blue-400 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download invoice
            </a>
        </div>
    
        <!-- Order Details -->
        <div class="flex flex-wrap gap-6 text-sm border-t border-gray-700 pt-4">
            <div>
                <span class="font-medium">Order date:</span> 01 May 2024
            </div>
            <div>
                <span class="font-medium">Email:</span> name@example.com
            </div>
            <div>
                <span class="font-medium">Payment method:</span> VISA
            </div>
        </div>
    
        <!-- Delivery Status -->
        <div class="mt-4 text-sm flex items-center">
            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Delivered on Friday 04 May 2024
        </div>
    </div>
</body>

</html>
