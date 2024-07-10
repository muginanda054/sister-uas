<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0 text-xl">Daftar Produk</h1>
                    @if (session()->has('error'))
                    <div>
                        {{ session('error') }}
                    </div>
                    @endif

                    <button class="mt-2 bg-green-600 font-medium px-4 py-2 rounded-md">
                        <a href="{{ url('products') }}" class="text-white no-underline">Kembali</a>
                    </button>

                    <form action="{{ url('admin/products/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <input type="text" name="judul" id="judul" class="text-black mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Judul" required>
                            @error('judul')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="text" name="kategory" id="kategory" class="text-black mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Kategori" required>
                            @error('kategory')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="text" name="harga" id="harga" class="text-black mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Harga" required>
                            @error('harga')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="file" name="photo" id="photo" class="text-black mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                            @error('photo')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
