<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Edit Kategori</h2>
    </x-slot>

    <div class="max-w-lg">
        <form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white rounded-xl shadow-sm border p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('nama_kategori', $category->nama_kategori) }}">
                @error('nama_kategori') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">Update</button>
                <a href="{{ route('categories.index') }}" class="px-4 py-2 text-gray-600 text-sm font-medium hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>