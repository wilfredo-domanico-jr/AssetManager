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
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">User</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage your system users</p>
                </div>

                <a href="{{ route('user.create') }}"
                    class="inline-flex items-center mt-4 sm:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add User
                </a>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            <!-- Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0 w-full mb-6">
                <form method="GET" action="{{ route('user.index') }}" id="filterForm" class="flex flex-wrap gap-2 w-full">

                    <!-- Search -->
                    <div class="relative w-full md:w-[79%]">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email ..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                    dark:bg-gray-800 dark:text-gray-100">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 dark:text-gray-300"></i>
                        </div>
                    </div>


                    <!-- Role -->
                    <div class="w-full md:w-[20%]">
                        <select name="role"
                            class="auto-submit w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                    dark:bg-gray-800 dark:text-gray-100">
                            <option value="">All Role</option>
                            <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="User" {{ request('role') == 'User' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                </form>
            </div>


            <!-- Asset Cards -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4">

                @forelse ($users as $user)
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $user->name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
                            <a href="{{ route('user.edit', $user->id) }}" class="hover:text-blue-500">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:text-red-500">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600 dark:text-gray-400 flex space-x-2">
                        <span>Created: {{ $user->created_at->format('M d, Y') }}</span>
                        <span>•</span>
                        <span>Updated: {{ $user->updated_at->format('M d, Y') }}</span>
                        <span>•</span>
                        <span>Role: {{ $user->role ?? 'N/A' }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-folder-open text-3xl mb-2"></i>
                    <p>No users found.</p>
                </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
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