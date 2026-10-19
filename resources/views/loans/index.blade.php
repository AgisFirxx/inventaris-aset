<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Data Peminjaman</h2>
    </x-slot>

    <div class="space-y-4">
        @if(session('success'))
            <div class="p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="flex gap-2">
            <a href="{{ route('loans.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Pinjam Aset
            </a>
            <a href="{{ route('loans.export') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" /></svg>
                Export Excel
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="p-4">Peminjam</th>
                        <th class="p-4">Aset</th>
                        <th class="p-4">Tgl Pinjam</th>
                        <th class="p-4">Tgl Kembali (Rencana)</th>
                        <th class="p-4">Tgl Kembali (Aktual)</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 text-gray-700">{{ $loan->user->name }}</td>
                        <td class="p-4 text-gray-700 font-medium">{{ $loan->asset->nama_aset }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->tanggal_pinjam }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->tanggal_kembali_rencana }}</td>
                        <td class="p-4 text-gray-700">{{ $loan->tanggal_kembali_aktual ?? '-' }}</td>
                        <td class="p-4">
                            @php
                                $isLate = $loan->status == 'dipinjam' && \Carbon\Carbon::parse($loan->tanggal_kembali_rencana)->isPast();
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($loan->status == 'dikembalikan') bg-green-100 text-green-700
                                @elseif($isLate) bg-red-100 text-red-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ $isLate ? 'terlambat' : $loan->status }}
                            </span>
                        </td>
                        <td class="p-4 space-x-3">
                            <a href="{{ route('loans.print', $loan) }}" target="_blank" class="text-gray-600 hover:underline">Cetak</a>
                            @if($loan->status == 'dipinjam')
                            <form action="{{ route('loans.return', $loan) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" class="text-green-600 hover:underline">Kembalikan</button>
                            </form>
                            @endif
                            <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="p-4 text-gray-400 text-center">Belum ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $loans->links() }}
        </div>
    </div>
</x-app-layout>