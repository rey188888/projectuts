<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 401</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
        <div class="text-6xl font-bold text-red-600 mb-4">401</div>
        <h1 class="text-2xl font-semibold mb-2">Unauthorized</h1>
        <p class="text-gray-600 mb-6">Oops! You do not have permission to access this page.</p>
        <button onclick="window.history.back()" class="bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300">
            Back to Previous Page
        </button>
    </div>
</body>

</html>