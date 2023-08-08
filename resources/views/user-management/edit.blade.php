<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form class="flex flex-col gap-2" method="POST"
                        action="{{ route('update-user', ['userId' => $user->id]) }}">
                        @csrf
                        @method('patch')
                        <div class="flex flex-col gap-2">
                            <label for="name">Name <span class="text-red-500 text-sm">*</span></label>
                            <input value="{{ old('name', $user->name) }}" type="text" id="name" name="name"
                                class="w-1/2 p-2 border-2 rounded-lg" required>
                        </div>
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col gap-2">
                            <label for="email">Email <span class="text-red-500 text-sm">*</span></label>
                            <input value="{{ old('email', $user->email) }}" type="text" id="email" name="email"
                                class="w-1/2 p-2 border-2 rounded-lg" required>
                        </div>
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col gap-2">
                            <label for="username">Username <span class="text-red-500 text-sm">*</span></label>
                            <input value="{{ old('username', $user->username) }}" type="text" id="username"
                                name="username" class="w-1/2 p-2 border-2 rounded-lg" required>
                        </div>
                        @error('username')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col gap-2">
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" class="w-1/2 p-2 border-2 rounded-lg">
                        </div>
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col gap-2">
                            <label for="role">Role <span class="text-red-500 text-sm">*</span></label>
                            <select value="{{ old('role', $user->role) }}" class="p-2 w-1/2 border-2 rounded-lg"
                                name="role" id="role" required>
                                <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                <option value="superadmin" @if ($user->role == 'superadmin') selected @endif>Superadmin
                                </option>
                            </select>
                        </div>
                        @error('role')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="mt-4 w-1/2 flex justify-end">
                            <button type="submit" class="p-3 bg-gray-500 text-white">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
