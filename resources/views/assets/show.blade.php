<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Detail Aset</h2>
    </x-slot>

    <div class="space-y-6">

        <!-- Info Aset -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $asset->nama_aset }}</h3>
                    <p class="text-sm text-gray-500">Kode: {{ $asset->kode_aset }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-medium
                    @if($asset->status == 'available') bg-green-100 text-green-700
                    @elseif($asset->status == 'dipinjam') bg-yellow-100 text-yellow-700
                    @else bg-red-100 text-red-700 @endif">
                    {{ $asset->status }}
                </span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 text-sm">
                <div>
                    <p class="text-gray-500">Kategori</p>
                    <p class="font-medium text-gray-800">{{ $asset->category->nama_kategori }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Kondisi</p>
                    <p class="font-medium text-gray-800">{{ $asset->kondisi }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Lokasi</p>
                    <p class="font-medium text-gray-800">{{ $asset->lokasi ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Total Dipinjam</p>
                    <p class="font-medium text-gray-800">{{ $loans->count() }} kali</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('assets.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Kembali ke Data Aset</a>
            </div>
        </div>

        <!-- Riwayat Peminjaman -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-5 py-4 border-b font-semibold text-gray-800">Riwayat Peminjaman</div>
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="p-4">Peminjam</th>
                        <th class="p-4">Tgl Pinjam</th>
                        <th class="p-4">Tgl Kembali (Rencana)</th>
                        <th class="p-4">Tgl Kembali (Aktual)</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 text-gray-700">{{ $loan->user->name }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->tanggal_pinjam }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->tanggal_kembali_rencana }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->tanggal_kembali_aktual ?? '-' }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($loan->status == 'dikembalikan') bg-green-100 text-green-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ $loan->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-4 text-gray-400 text-center">Aset ini belum pernah dipinjam.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>