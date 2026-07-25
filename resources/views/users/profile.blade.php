@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
    <div class="flex items-center mb-6 pb-6 border-b">
        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
            {{ strtoupper(substr($user->fullname, 0, 1)) }}
        </div>
        <div class="ml-4">
            <h2 class="text-3xl font-bold text-gray-800">{{ $user->fullname }}</h2>
            <p class="text-gray-500 text-sm">@{{ $user->username }}</p>
            <p class="text-gray-600 text-sm mt-1">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">{{ $user->role }}</span>
            </p>
        </div>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded mb-4 border border-red-200">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="bg-green-50 text-green-600 p-4 rounded mb-4 border border-green-200">
        ✓ {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-gray-700 text-sm mb-2">Nama Lengkap*</label>
            <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-transparent" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700 text-sm mb-2">Username</label>
            <input type="text" value="{{ $user->username }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
            <p class="text-xs text-gray-500 mt-1">Username tidak dapat diubah</p>
        </div>

        <div>
            <label class="block font-medium text-gray-700 text-sm mb-2">Role</label>
            <input type="text" value="{{ $user->role }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
            <p class="text-xs text-gray-500 mt-1">Role tidak dapat diubah</p>
        </div>

        <div class="border-t pt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Ubah Password</h3>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-2">Password Baru (Opsional)</label>
                <input type="password" name="password" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-transparent" placeholder="Kosongkan jika tidak ingin mengubah password">
                <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter</p>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-6 border-t">
            <a href="{{ route('dashboard') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-6 rounded-lg transition-colors">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-8 rounded-lg transition-colors shadow-md">Simpan Perubahan</button>
        </div>
    </form>

    <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
        <h3 class="font-semibold text-gray-700 mb-2">Informasi Akun</h3>
        <div class="space-y-2 text-sm text-gray-600">
            <p><span class="font-medium">Terdaftar sejak:</span> {{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}</p>
            <p><span class="font-medium">Terakhir diubah:</span> {{ $user->updated_at ? $user->updated_at->format('d M Y H:i') : '-' }}</p>
        </div>
    </div>
</div>
@endsection
