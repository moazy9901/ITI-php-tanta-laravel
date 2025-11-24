<x-app-layout>
    <div
        class="bg-white dark:bg-slate-900 min-h-[30rem] w-[35rem] my-7 mx-auto relative md:col-span-4 rounded-xl shadow-md border border-gray-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-200">
    @php $s = $product->is_active ?? true ; @endphp

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
            @if (!empty($product->image))
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}"
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
                        {{ $product->name}}
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                       category is :  {{$product->category ? $product->category->slug : "no category"}}
                    </div>
                </div>
            </div>
        </div>

        <!-- product Details -->
        <div class="mt-5 space-y-3 text-center">
        <div class="mt-4 text-gray-600 dark:text-gray-300 space-y-4 leading-relaxed">
           {{ $product->description }}
        </div>
            <!-- price -->
            @if ($product->price)
                <div class="flex justify-center items-center gap-2 text-gray-600 dark:text-gray-300 text-sm">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>
                        {{ $product->price ? '$' . number_format($product->price) : 'N/A' }}
                    </span>
                </div>
            @endif

             @if ($product->stock_quantity)
                <div class="flex justify-center items-center gap-2 text-gray-600 dark:text-gray-300 text-sm">
                   <svg class="h-5 w-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    <span>
                        {{ $product->stock_quantity ?  number_format($product->stock_quantity) .' '.'items' : 'N/A' }}
                    </span>
                </div>
            @endif

        </div>




        <!-- Notes -->
        <div class="mt-3 text-xs text-center text-gray-500">
            {{ $product->created_at ? 'Remote · Matches your preferences' : '' }}
            created by {{ $product->creator ? $product->creator->name : 'anonimous'  }}
        </div>
    </div>
    </div>
</x-app-layout>
