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

                    <form class="flex flex-col gap-2" method="POST" action="{{ route('create-user') }}">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="name">Name <span class="text-red-500 text-sm">*</span></label>
                            <input value="{{ old('name') }}" type="text" id="name" name="name"
                                class="w-1/2 p-2 border-2 rounded-lg" required>
                        </div>
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col gap-2">
                            <label for="email">Email <span class="text-red-500 text-sm">*</span></label>
                            <input value="{{ old('email') }}" type="text" id="email" name="email"
                                class="w-1/2 p-2 border-2 rounded-lg" required>
                        </div>
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col gap-2">
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" class="w-1/2 p-2 border-2 rounded-lg">
                        </div>
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        @if (Auth::user()->role == 'superadmin')
                            <div class="flex flex-col gap-2">
                                <label for="role">Role <span class="text-red-500 text-sm">*</span></label>
                                <select class="p-2 w-1/2 border-2 rounded-lg" name="role" id="role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Superadmin</option>
                                </select>
                            </div>
                            @error('role')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        @endif
                        <div class="mt-4 w-1/2 flex justify-end">
                            <button type="submit" class="p-3 bg-gray-500 text-white">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
