
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Cards Grid -->
        @if ($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4">

                        <!-- Image -->
                        <div class="w-full h-40 bg-gray-200 rounded-lg overflow-hidden mb-4">
                            @if($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image">

                            @else
                                <div class="flex items-center justify-center h-full text-gray-500">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <!-- Product Name -->
                        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>

                        <!-- Price -->
                        <p class="text-gray-700 font-medium mt-1">
                            ${{ number_format($product->price, 2) }}
                        </p>

                        <!-- Category -->
                        <p class="text-sm text-gray-500 mt-1">{{ $product->category }}</p>

                        <!-- Active Status -->
                        <p class="mt-2">
                            @if ($product->is_active)
                                <span class="text-green-600 font-semibold">Active</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactive</span>
                            @endif
                        </p>

                        <!-- Buttons -->
                        <div class="flex justify-between mt-4 space-x-2">

                            <a href="{{ route('products.show', $product->id) }}"
                               class="flex-1 text-center py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                View
                            </a>

                            <a href="{{ route('products.edit', $product->id) }}"
                               class="flex-1 text-center py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                {{ $products->links() }}
            </div>

        @else
            <div class="text-center text-gray-500 text-lg py-20">
                No products found.
            </div>
        @endif

    </div>

</x-app-layout>
