@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h2>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
    </div>
    @endif

    @php
    $selectedRole = old('role', $user->role ?? '');
    $isSalesRole = strtolower($selectedRole) === 'sales';
    @endphp

    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700">Nama Lengkap*</label>
                <input type="text" name="fullname" value="{{ old('fullname', $user->fullname ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Role Jabatan*</label>
                <select name="role" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
                    <option value="Manager" {{ old('role', $user->role ?? '') == 'Manager' ? 'selected' : '' }}>Manager / Owner</option>
                    <option value="Admin" {{ old('role', $user->role ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Sales" {{ old('role', $user->role ?? '') == 'Sales' ? 'selected' : '' }}>Sales</option>
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Email Utama</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">
            </div>
            <div class="col-span-2 border-t pt-4 mt-2">
                <h3 class="font-semibold text-gray-600 mb-2">Informasi Login</h3>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Username*</label>
                <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}" class="font-mono w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div id="password-field-wrapper" class="{{ $isSalesRole ? 'hidden' : '' }}">
                <label class="block font-medium text-gray-700">Password {{ isset($user) ? '(Kosongkan jika tidak diganti)' : '*' }}</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" {{ isset($user) ? '' : 'required' }}>
            </div>
        </div>
        <div class="pt-4 flex justify-between space-x-4">
            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">Simpan Profil</button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.querySelector('select[name="role"]');
        const passwordWrapper = document.getElementById('password-field-wrapper');
        const passwordInput = passwordWrapper ? .querySelector('input[name="password"]');

        const togglePasswordField = () => {
            if (!roleSelect || !passwordWrapper || !passwordInput) return;
            const isSales = roleSelect.value === 'Sales';
            passwordWrapper.classList.toggle('hidden', isSales);
            passwordInput.required = !isSales;
        };

        roleSelect ? .addEventListener('change', togglePasswordField);
        togglePasswordField();
    });

</script>
@endsection
