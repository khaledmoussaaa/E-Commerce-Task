<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class="bg-gray-100 relative">
    <!-- Navbar -->
    <nav id="#top" class="backdrop-blur-lg drop-shadow-2xl p-4 px-10 flex justify-between items-center sticky top-0 z-10">
        <a href="/" class="text-lg font-bold">E-Commerce</a>
        <livewire:cart-component />
    </nav>

    <!-- Slot -->
    <div class="container mx-auto p-6 ">
        {{ $slot }}
        
        <!-- Scroll to Top Button -->
        <a href="#top"
            class="fixed bottom-6 right-6 sm:bottom-10 sm:right-10 text-3xl text-gray-500 hover:text-gray-700 transition-all">
            <i class="bi bi-arrow-up-circle-fill"></i>
        </a>
    </div>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>