<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Report Email Settings
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Configure email addresses to receive summary CSV reports
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Email Configuration Form --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 space-y-6">
                <form method="POST" action="{{ route('admin.report-email-setting.update') }}">
                    @csrf

                    <div>
                        <label for="emails" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">
                            Email Addresses
                        </label>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                            Enter one or more emails separated by commas (e.g., admin@example.com, manager@example.com)
                        </p>
                        <input type="text" name="emails" id="emails"
                            value="{{ old('emails', $emails ?? '') }}"
                            placeholder="admin@example.com, manager@example.com"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('emails')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                            Save Emails
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>