@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen User</h2>
        <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
            + Tambah User
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Nama Lengkap & Kontak</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Username / Akses Login</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Role Jabatan</th>
                    <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 font-medium">{{ $user->fullname }}<br><span class="text-sm font-normal text-gray-500">📞 {{ $user->phone ?? '-' }} | ✉ {{ $user->email ?? '-' }}</span></td>
                    <td class="py-3 px-4 font-mono text-blue-600">{{ $user->username }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-xs rounded font-bold {{ strtolower($user->role) === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">{{ $user->role }}</span>
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit Hak Akses</a>
                        @if(auth()->id() !== $user->id)
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Hapus user ini selamanya?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection
