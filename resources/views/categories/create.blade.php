<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('categories') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">

        <h1 class="text-3xl font-bold mb-6">Add New category</h1>

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

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- GRID LAYOUT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- category Name --}}
                <div class="md:col-span-2">
                    <label class="block mb-1 font-semibold">category Slug</label>
                    <input type="text" name="slug"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('slug') }}" required>
                </div>



                {{-- Description (Full width) --}}
                <div class="md:col-span-2">
                    <label class="block mb-1 font-semibold">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                </div>

                {{-- Image Upload + Preview --}}
                <div class="md:col-span-2">
                    <label class="block mb-1 font-semibold">category Image</label>

                    <input type="file" name="image" id="imageInput"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">

                    {{-- Preview --}}
                    <div class="mt-3">
                        <img id="previewImage" src="#" alt="Image Preview"
                            class="hidden w-48 h-48 object-cover rounded-lg border">
                    </div>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('categories.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Back
                </a>

                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save category
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
