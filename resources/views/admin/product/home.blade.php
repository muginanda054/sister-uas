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
                    <div class="flex items-center justify-between">
                        <h1 class="mb-0 text-xl">Daftar Produk</h1>
                        <button class="mt-2 bg-green-600 font-medium px-4 py-2 rounded-md">
                            <a href="{{('products/create') }}" class="text-white no-underline">Tambah Produk</a>
                        </button>
                    </div>
                    @if(Session::has('success'))
                        <div class="alert alert-success mt-4 p-4 bg-green-100 text-green-800 rounded-md" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <div class="mt-6">
                        <table class="min-w-full leading-normal">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Photo</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $product->judul }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $product->kategory }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $product->harga }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if ($product->photo)
                                        <img src="{{ asset('img/' . $product->photo) }}" alt="{{ $product->judul }}" class="w-16 h-16 object-cover">
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin/products/edit', ['id'=>$product->id]) }}" type="button" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-xl text-sm px-4 py-2 mb-4">Edit</a>
                                            <a href="{{ route('admin/products/delete', ['id'=>$product->id]) }}" type="button" class="text-white bg-red-800 hover:text-red-900 font-medium rounded-xl text-sm px-4 py-2">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center py-5 border-b border-gray-200 bg-white text-sm" colspan="6">Product not found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
