<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('edit Products') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">

        <h1 class="text-3xl font-bold mb-6">Add New Product</h1>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- GRID LAYOUT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Product Name --}}
                <div>
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" name="name"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('name' , $product->name) }}" required>
                </div>

                {{-- Price --}}
                <div>
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" step="0.01" name="price"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('price' , $product->price) }}" required>
                </div>

                {{-- Category (SELECT) --}}
                <div>
                    <label class="block mb-1 font-semibold">Category</label>
                    <select name="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Choose Category</option>
                        @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id' , $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->slug }}
                                </option>
                            @endforeach
                         </select>
                </div>

                {{-- Stock Quantity --}}
                <div>
                    <label class="block mb-1 font-semibold">Stock Quantity</label>
                    <input type="number" name="stock_quantity"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('stock_quantity', $product->stock_quantity) }}">
                </div>

                {{-- Description (Full width) --}}
                <div class="md:col-span-2">
                    <label class="block mb-1 font-semibold">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description' , $product->description) }}</textarea>
                </div>

                {{-- Image Upload + Preview --}}
                <div  class="md:col-span-2">
                    <label class="block mb-1 font-semibold">Product Image</label>

                    <input type="file" name="image" id="imageInput"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">

                    {{-- Preview --}}
                    <div class="mt-3">
                        <img id="previewImage" src="{{ $product->image ? asset('storage/products/' . $product->image) : '' }}" alt="Image Preview"
                            class="w-48 h-48 object-cover rounded-lg border">
                    </div>
                </div>

                {{-- Active --}}
                <div class="md:col-span-2 mt-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? "checked" : ""}} >
                        <span>Active Product</span>
                    </label>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('products.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Back
                </a>

                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save Product
                </button>
            </div>

        </form>

    </div>

    {{-- IMAGE PREVIEW SCRIPT --}}
    <script>
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewImage.classList.remove('hidden');
            }
        });
    </script>
</x-app-layout>
