<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Pinjam Aset</h2>
    </x-slot>

    <div class="max-w-lg">
        <form action="{{ route('loans.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border p-6 space-y-4">
            @csrf

            @if ($errors->any())
                <div class="p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Pilih Aset</label>
                <select name="asset_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Aset --</option>
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->nama_aset }} ({{ $asset->kode_aset }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Kembali (Rencana)</label>
                <input type="date" name="tanggal_kembali_rencana" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('tanggal_kembali_rencana') }}">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">Pinjam</button>
                <a href="{{ route('loans.index') }}" class="px-4 py-2 text-gray-600 text-sm font-medium hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>