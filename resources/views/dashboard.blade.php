<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="space-y-2">
                        <p class="text-lg font-semibold">
                            Welcome, {{ Auth::user()->name }} 👋
                        </p>

                        <p class="text-sm text-gray-600">
                            Your role:
                            <span class="px-2 py-1 bg-gray-200 rounded text-gray-800">
                                {{ Auth::user()->role }}
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

