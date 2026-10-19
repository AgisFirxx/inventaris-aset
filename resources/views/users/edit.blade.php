<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Ubah Role User</h2>
    </x-slot>

    <div class="max-w-lg">
        <form action="{{ route('users.update', $user) }}" method="POST" class="bg-white rounded-xl shadow-sm border p-6 space-y-4">
            @csrf @method('PUT')

            <div>
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-medium text-gray-800">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium text-gray-800">{{ $user->email }}</p>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Role</label>
                <select name="role" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="admin" @selected($user->role == 'admin')>Admin</option>
                    <option value="karyawan" @selected($user->role == 'karyawan')>Karyawan</option>
                </select>
                @error('role') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">Update</button>
                <a href="{{ route('users.index') }}" class="px-4 py-2 text-gray-600 text-sm font-medium hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>