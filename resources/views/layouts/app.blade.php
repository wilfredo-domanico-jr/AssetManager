<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Asset Manager') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">

        <!-- Mobile Sidebar Backdrop -->
        <div
            x-show="sidebarOpen"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
            @click="sidebarOpen = false"
            x-cloak></div>

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 shadow-md transform transition-transform duration-300 lg:translate-x-0 flex flex-col">
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200 dark:border-gray-700">
                <span class="text-xl font-semibold text-gray-700 dark:text-gray-100">{{ config('app.name', 'Asset Manager') }}</span>
                <button class="lg:hidden text-gray-500 dark:text-gray-300" @click="sidebarOpen = false">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                    <i class="fa-solid fa-chart-line text-gray-500 dark:text-gray-300"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('assets.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('assets.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                    <i class="fa-solid fa-boxes-stacked text-gray-500 dark:text-gray-300"></i>
                    <span>Assets</span>
                </a>
                <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('reports.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                    <i class="fa-solid fa-file-lines text-gray-500 dark:text-gray-300"></i>
                    <span>Reports</span>
                </a>


                <!-- 🔹 Separator -->
                <hr class="border-t border-gray-300 dark:border-gray-700 my-2">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4 mb-2 px-3">
                    Admin Section
                </div>
                <a href="{{ route('category.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('category.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                    <i class="fa-solid fa-file-lines text-gray-500 dark:text-gray-300"></i>
                    <span>Categories</span>
                </a>

                <a href="{{ route('department.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('department.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                    <i class="fa-solid fa-file-lines text-gray-500 dark:text-gray-300"></i>
                    <span>Departments</span>
                </a>



            </nav>

            <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <i class="fa-solid fa-power-off text-gray-500 dark:text-gray-300"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow flex items-center justify-between px-4 lg:px-8 py-4">
                <div class="flex items-center gap-3">
                    <button class="lg:hidden text-gray-600 dark:text-gray-300" @click="sidebarOpen = true">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    @isset($header)
                    {{ $header }}
                    @endisset
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Alpine.js for toggle -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>