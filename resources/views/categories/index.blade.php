<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('categories') }}
        </h2>
        <div class="flex items-center">
            <a href="{{ route('categories.create') }}"
                class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">{{ __('Create Category') }}</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Cards Grid -->
        @if ($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($categories as $category)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4">

                        <!-- Image -->
                        <div class="w-full h-40 bg-gray-200 rounded-lg overflow-hidden mb-4">
                            @if ($category->image)
                                <img src="{{ asset('storage/categories/' . $category->image) }}" alt="category Image">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-500">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <!-- category Name -->
                        <h2 class="text-xl font-semibold">{{ $category->slug }}</h2>




                        <!-- Buttons -->
                        <div class="flex justify-between mt-4 space-x-2">

                            <a href="{{ route('categories.show', $category->id) }}"
                                class="flex-1 text-center py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                View
                            </a>
                            
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="flex-1 text-center py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                class="flex-1"
                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button class="w-full py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center text-gray-500 text-lg py-20">
                No categories found.
            </div>
        @endif

    </div>

</x-app-layout>
