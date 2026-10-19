<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Tambah Aset</h2>
    </x-slot>

    <div class="max-w-lg">
        <form action="{{ route('assets.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border p-6 space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kode Aset</label>
                <input type="text" name="kode_aset" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('kode_aset') }}">
                @error('kode_aset') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Aset</label>
                <input type="text" name="nama_aset" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('nama_aset') }}">
                @error('nama_aset') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kondisi</label>
                <select name="kondisi" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="baik">Baik</option>
                    <option value="rusak ringan">Rusak Ringan</option>
                    <option value="rusak berat">Rusak Berat</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('lokasi') }}">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">Simpan</button>
                <a href="{{ route('assets.index') }}" class="px-4 py-2 text-gray-600 text-sm font-medium hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>