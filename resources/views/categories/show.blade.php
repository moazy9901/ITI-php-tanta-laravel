<x-app-layout>
    <div
        class="bg-white dark:bg-slate-900 min-h-[30rem] w-[35rem] my-7 mx-auto relative md:col-span-4 rounded-xl shadow-md border border-gray-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-200">
    @php $s = $category->is_active ?? true ; @endphp

                        <span
                            class="px-3 absolute top-3 right-3 py-1 rounded-full text-xs font-medium flex items-center gap-2
            {{ $s
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700' }}">

                            <span
                                class="w-2 h-2 rounded-full
                {{ $s
                    ? 'bg-green-500'
                            : 'bg-red-500' }}">
                            </span>

                            {{ ucfirst($s?"active":"not active") }}
                        </span>
        <div
            class="w-44 h-44 mx-auto mb-5 rounded-full overflow-hidden bg-gray-100 dark:bg-slate-700 border border-gray-200 dark:border-slate-600 flex items-center justify-center">
            @if (!empty($category->image))
                <img src="{{ asset('storage/categories/' . $category->image) }}" alt="{{ $category->title }}"
                    class="w-full h-full object-cover">
            @else
                <svg class="w-7 h-7 text-gray-300 dark:text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            @endif
        </div>

        <!-- Header: Logo + Info + Status -->
        <div class="flex items-center justify-center">
            <div class="flex items-center justify-center text-center gap-4">
                <div class="text-center">
                    <div class="text-base font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                        {{ $category->slug}}
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $category->category }}
                    </div>
                </div>
            </div>
        </div>

        <!-- category Details -->
        <div class="mt-5 space-y-3 text-center">
        <div class="mt-4 text-gray-600 dark:text-gray-300 space-y-4 leading-relaxed">
           {{ $category->description }}
        </div>

        </div>




        <!-- Notes -->
        <div class="mt-3 text-xs text-center text-gray-500">
            {{ $category->created_at ? 'Remote · Matches your preferences' : '' }}
            created by {{ $category->creator ? $category->creator->name : 'anonimous'  }}
        </div>
    </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Cards Grid -->
        @if ($category->products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($category->products as $product)
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
                        <p class="text-sm text-gray-500 mt-1"> {{$product->category ? $product->category->slug : "no category"}}</p>

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
            {{-- <div class="mt-8">
                {{ $products->links() }}
            </div> --}}

        @else
            <div class="text-center text-gray-500 text-lg py-20">
                No products found.
            </div>
        @endif

    </div>

</x-app-layout>
