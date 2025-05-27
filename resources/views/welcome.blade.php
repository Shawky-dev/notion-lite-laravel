<!-- filepath: e:\Coding\Laravel\livewire-test\resources\views\welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notion-Lite</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-gray-800">Notion-Lite</span>
            <div class="flex space-x-3">
                <a href="/login" class="px-3 py-2 text-sm rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200">
                    Log in
                </a>
                <a href="/register" class="px-3 py-2 text-sm rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Sign up
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-12">
        <div class="md:flex md:items-center md:space-x-8">
            <div class="md:w-1/2">
                <h1 class="text-3xl font-bold text-gray-900 md:text-4xl">
                    <span class="block">Your thoughts,</span>
                    <span class="block text-indigo-600">organized simply</span>
                </h1>
                <p class="mt-4 text-gray-500">
                    Notion-Lite helps you organize your notes, tasks, and ideas in one simple workspace.
                </p>
                <div class="mt-6 flex flex-col sm:flex-row sm:space-x-3">
                    <a href="/register" class="px-4 py-2 text-center rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Get started for free
                    </a>
                    
                </div>
            </div>
            <div class="mt-8 md:mt-0 md:w-1/2">
                <div class="rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="App screenshot" class="w-full">
                </div>
            </div>
        </div>

    
    </main>

    
</body>
</html>