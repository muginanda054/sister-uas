<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <button class="mt-2 bg-green-600 font-medium px-4 py-2 rounded-md flex gap-1 items-center">
                        <a href="{{('products') }}" class="text-white">Produk</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
