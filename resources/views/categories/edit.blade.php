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


            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit Category</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Update existing category details</p>
                </div>
            </div>


            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 space-y-6">

                <form action="{{ route('category.update', $category->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')


                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Category Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                            dark:bg-gray-800 dark:text-gray-100" required>
                    </div>

                    <div class="mb-5">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                            dark:bg-gray-800 dark:text-gray-100">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('category.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                            Update Category
                        </button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</x-app-layout>