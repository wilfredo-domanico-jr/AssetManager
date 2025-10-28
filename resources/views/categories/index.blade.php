<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Asset Manager
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Track and manage your equipment assets
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header + Add Button --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Categories</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage asset categories</p>
                </div>

                <a href="{{ route('category.create') }}"
                    class="inline-flex items-center mt-4 sm:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Category
                </a>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Search Bar --}}
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0 w-full mb-6">
                <div class="relative w-full md:w-[40%]">
                    <form method="GET" action="{{ route('category.index') }}">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   dark:bg-gray-800 dark:text-gray-100">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 dark:text-gray-300"></i>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Categories List --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4">

                @forelse ($categories as $category)
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ $category->description ?? 'No description provided' }}
                            </p>
                        </div>
                        <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
                            <a href="{{ route('category.edit', $category->id) }}" class="hover:text-blue-500">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this category?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:text-red-500">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Created: {{ $category->created_at->format('M d, Y') }}
                    </div>
                </div>
                @empty
                <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-folder-open text-3xl mb-2"></i>
                    <p>No categories found.</p>
                </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
</x-app-layout>