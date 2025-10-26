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

            <!-- Top Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Assets</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage your inventory and equipment</p>
                </div>

                <a href="{{ route('assets.create') }}"
                    class="inline-flex items-center mt-4 sm:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Asset
                </a>
            </div>

            <!-- Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0 w-full mb-6">
                <form method="GET" action="{{ route('assets.index') }}" id="filterForm" class="flex flex-wrap gap-2 w-full">

                    <!-- Search -->
                    <div class="relative w-full md:w-[35%]">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search assets..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                    dark:bg-gray-800 dark:text-gray-100">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 dark:text-gray-300"></i>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="relative w-full md:w-[20%]">
                        <select name="category"
                            class="auto-submit w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                    dark:bg-gray-800 dark:text-gray-100 appearance-none">
                            <option value="">All Categories</option>
                            <option value="PPE" {{ request('category') == 'PPE' ? 'selected' : '' }}>PPE</option>
                            <option value="Small Tools" {{ request('category') == 'Small Tools' ? 'selected' : '' }}>Small Tools</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <i class="fa-solid fa-chevron-down text-gray-400 dark:text-gray-300"></i>
                        </div>
                    </div>

                    <!-- Department -->
                    <div class="w-full md:w-[22%]">
                        <select name="department"
                            class="auto-submit w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                    dark:bg-gray-800 dark:text-gray-100">
                            <option value="">All Departments</option>
                            <option value="Main Office" {{ request('department') == 'Main Office' ? 'selected' : '' }}>Main Office</option>
                            <option value="Warehouse 1" {{ request('department') == 'Warehouse 1' ? 'selected' : '' }}>Warehouse 1</option>
                            <option value="Warehouse 2" {{ request('department') == 'Warehouse 2' ? 'selected' : '' }}>Warehouse 2</option>
                        </select>
                    </div>

                    <!-- Condition -->
                    <div class="w-full md:w-[20%]">
                        <select name="condition"
                            class="auto-submit w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                    dark:bg-gray-800 dark:text-gray-100">
                            <option value="">All Conditions</option>
                            <option value="Excellent" {{ request('condition') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                            <option value="Good" {{ request('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                            <option value="Needs Repair" {{ request('condition') == 'Needs Repair' ? 'selected' : '' }}>Needs Repair</option>
                        </select>
                    </div>

                </form>
            </div>


            <!-- Asset Cards -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4">

                @forelse ($assets as $asset)
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $asset->asset_name }}
                            </h3>
                            <div class="flex flex-wrap gap-2 mt-1">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">{{ $asset->category }}</span>
                                <span class="px-3 py-1 rounded-full 
                                        @if($asset->condition == 'Excellent') bg-green-100 text-green-700
                                        @elseif($asset->condition == 'Good') bg-blue-100 text-blue-700
                                        @else bg-yellow-100 text-yellow-700 @endif
                                        text-xs font-medium">
                                    {{ $asset->condition ?? 'Unknown' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
                            <a href="{{ route('assets.edit', $asset->id) }}">
                                <i class="fa-solid fa-pen hover:text-blue-500 cursor-pointer"></i>
                            </a>

                            <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this asset?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fa-solid fa-trash hover:text-red-500 cursor-pointer"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Purchase Cost</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                ₱{{ number_format($asset->purchase_cost ?? 0, 2) }}
                            </p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Book Value</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                ₱{{ number_format($asset->purchase_cost ?? 0, 2) }}
                            </p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Age</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                {{ $asset->purchase_date ? now()->diffInYears($asset->purchase_date) . ' years' : 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Department</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $asset->department ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500 dark:text-gray-400 py-10">
                    <i class="fa-solid fa-box-open text-4xl mb-3"></i>
                    <p>No assets found.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');

            // Auto-submit on dropdown change
            document.querySelectorAll('.auto-submit').forEach(select => {
                select.addEventListener('change', () => form.submit());
            });

            // Submit on Enter key in the search field
            const searchInput = form.querySelector('input[name="search"]');
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>