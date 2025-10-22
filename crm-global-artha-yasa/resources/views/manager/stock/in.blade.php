@extends('layouts.app')

{{-- Menggunakan section untuk header --}}
@section('header', 'Stock In: Barang Masuk dari Pabrik')

@section('content')
    <div class="container">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Pencatatan Stock In</h2>
        <p class="text-gray-600 mb-6">Gunakan formulir ini untuk mencatat produk yang baru masuk dari pabrik ke gudang
            utama.</p>

        {{-- Form Stock In --}}
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <form method="POST" action="{{ route('manager.stock.in') }}">
                @csrf

                {{-- Input Produk --}}
                <div class="mb-4">
                    <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
                    {{-- Anda harus melewatkan daftar produk dari Controller ke View --}}
                    <select name="product_id" id="product_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Pilih...</option>
                        {{-- @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach --}}
                    </select>
                </div>

                {{-- Input Kuantitas --}}
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Kuantitas Masuk (Pcs)</label>
                    <input type="number" name="quantity" id="quantity" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                {{-- Input Catatan/Supplier --}}
                <div class="mb-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan / Supplier</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700">Catat Stock
                    In</button>
            </form>
        </div>
    </div>
@endsection