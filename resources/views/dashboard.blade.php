<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Dashboard</h2>
        <p class="text-sm text-gray-500 mt-1">Ringkasan kondisi aset & peminjaman saat ini</p>
    </x-slot>

    <div class="space-y-6">

        <!-- Ringkasan Aset -->
        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Ringkasan Aset</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm border p-5 flex items-center gap-4">
                    <div class="bg-blue-100 text-blue-600 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Aset</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalAssets }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border p-5 flex items-center gap-4">
                    <div class="bg-green-100 text-green-600 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Available</p>
                        <p class="text-2xl font-bold text-green-600">{{ $availableAssets }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border p-5 flex items-center gap-4">
                    <div class="bg-yellow-100 text-yellow-600 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Dipinjam</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $borrowedAssets }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border p-5 flex items-center gap-4">
                    <div class="bg-red-100 text-red-600 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Rusak</p>
                        <p class="text-2xl font-bold text-red-600">{{ $rusakAssets }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Peminjaman -->
        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Ringkasan Peminjaman</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-xl shadow-sm border p-5 flex items-center gap-4">
                    <div class="bg-blue-100 text-blue-600 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Peminjaman Aktif</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $activeLoans }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border p-5 flex items-center gap-4">
                    <div class="bg-red-100 text-red-600 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Terlambat</p>
                        <p class="text-2xl font-bold text-red-600">{{ $lateLoans }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman Terbaru -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-5 py-4 border-b font-semibold text-gray-800">Peminjaman Terbaru</div>
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="p-4">Peminjam</th>
                        <th class="p-4">Aset</th>
                        <th class="p-4">Tgl Pinjam</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($recentLoans as $loan)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 text-gray-700">{{ $loan->user->name }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->asset->nama_aset }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->tanggal_pinjam }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($loan->status == 'dikembalikan') bg-green-100 text-green-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ $loan->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-4 text-gray-400 text-center">Belum ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>