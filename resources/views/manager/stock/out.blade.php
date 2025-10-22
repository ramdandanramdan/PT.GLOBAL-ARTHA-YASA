@extends('layouts.app')

{{-- Menggunakan section untuk header --}}
@section('header', 'Stock Out: Distribusi ke Sales')

@section('content')
    <div class="container">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Pencatatan Stock Out</h2>
        <p class="text-gray-600 mb-6">Gunakan formulir ini untuk mencatat produk yang dikeluarkan dari gudang dan diberikan
            kepada Sales/SPG.</p>

        {{-- Form Stock Out --}}
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <form method="POST" action="{{ route('manager.stock.out') }}">
                @csrf

                {{-- Pilih User Penerima (Sales/SPG) --}}
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Diberikan Kepada
                        (Sales/SPG)</label>
                    {{-- Anda harus melewatkan daftar user dari Controller ke View --}}
                    <select name="user_id" id="user_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Pilih Sales/SPG...</option>
                        {{-- @foreach ($salesUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role->name ?? '' }})</option>
                        @endforeach --}}
                    </select>
                </div>

                {{-- Input Produk --}}
                <div class="mb-4">
                    <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
                    {{-- Anda harus melewatkan daftar produk dari Controller ke View --}}
                    <select name="product_id" id="product_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Pilih...</option>
                        {{-- @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stok Gudang: X)</option>
                        @endforeach --}}
                    </select>
                </div>

                {{-- Input Kuantitas --}}
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Kuantitas Keluar (Pcs)</label>
                    <input type="number" name="quantity" id="quantity" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">Catat Stock
                    Out</button>
            </form>
        </div>
    </div>
@endsection