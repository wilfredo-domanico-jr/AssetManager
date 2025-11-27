<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                User Manager
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Add and manage users
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Top Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit User</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Update existing user details</p>
                </div>

            </div>

            {{-- Flash Message --}}
            @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 space-y-6">

                <form class="space-y-6" method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PUT')


                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                        <!-- Role -->
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="" selected>Select Role</option>
                                <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ old('role', $user->role) == 'User' ? 'selected' : '' }}>User</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('user.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                            Update User
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>



</x-app-layout>