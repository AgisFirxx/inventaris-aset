<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Data Aset</h2>
    </x-slot>

    <div class="space-y-4">
        @if(session('success'))
            <div class="p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <a href="{{ route('assets.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Aset
        </a>

        <form method="GET" action="{{ route('assets.index') }}" class="bg-white rounded-xl shadow-sm border p-4 flex flex-wrap gap-3">
            <input type="text" name="search" placeholder="Cari nama/kode aset..." value="{{ request('search') }}" class="flex-1 min-w-[200px] border-gray-300 rounded-lg shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500">

            <select name="status" class="border-gray-300 rounded-lg shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="available" @selected(request('status') == 'available')>Available</option>
                <option value="dipinjam" @selected(request('status') == 'dipinjam')>Dipinjam</option>
            </select>

            <select name="category_id" class="border-gray-300 rounded-lg shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->nama_kategori }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg">Filter</button>
            <a href="{{ route('assets.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg">Reset</a>
        </form>

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="p-4">Kode</th>
                        <th class="p-4">Nama Aset</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Kondisi</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($assets as $asset)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 text-gray-700">{{ $asset->kode_aset }}</td>
                        <td class="p-4 text-gray-700 font-medium">{{ $asset->nama_aset }}</td>
                        <td class="p-4 text-gray-700">{{ $asset->category->nama_kategori }}</td>
                        <td class="p-4 text-gray-700">{{ $asset->kondisi }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($asset->status == 'available') bg-green-100 text-green-700
                                @elseif($asset->status == 'dipinjam') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $asset->status }}
                            </span>
                        </td>
                        <td class="p-4 space-x-3">
                            <a href="{{ route('assets.show', $asset) }}" class="text-gray-600 hover:underline">Detail</a>
                            <a href="{{ route('assets.edit', $asset) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="p-4 text-gray-400 text-center">Tidak ada data aset.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $assets->links() }}
        </div>
    </div>
</x-app-layout>