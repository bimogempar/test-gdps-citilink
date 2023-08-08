<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end pb-6">
                <a href="{{ route('add-user-page') }}"><button class="p-3 bg-gray-500 text-white">Add User</button></a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table w-full text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-gray-500 text-white">
                            <tr>
                                <th class="p-3">Name</th>
                                <th class="p-3">Username</th>
                                <th class="p-3">Role</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $idx => $user)
                                <tr class="bg-white">
                                    <td class="p-3">
                                        <div class="flex items-center space-x-6">
                                            <img class="rounded-full h-12 w-12 border-2 object-cover"
                                                src="https://www.gotosovie.com/wp-content/uploads/woocommerce-placeholder.png"
                                                alt="unsplash image">
                                            <div class="ml-3">
                                                <div class="text-gray-500">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3 text-center">
                                        {{ $user->username }}
                                    </td>
                                    <td class="p-3 text-center">
                                        {{ $user->role }}
                                    </td>
                                    <td class="p-3 text-center">
                                        {{ $user->email }}
                                    </td>
                                    <td class="p-3">
                                        {{-- <a id="{{ $user }}" href="{{ route('edit-user', ['id' => $user->id]) }}"
                                            class="hover:cursor-pointer emp text-gray-400 hover:text-gray-500 mr-2">
                                            <i class="material-icons-outlined text-base">visibility</i>
                                        </a> --}}
                                        <a href="{{ route('edit-user-page', ['userId' => $user->id]) }}"
                                            class="hover:cursor-pointer
                                            emp text-gray-400 hover:text-gray-500 mx-2">
                                            <i class="material-icons-outlined text-base">edit</i>
                                        </a>
                                        <a id="{{ $user->id }}"
                                            class="delete-user hover:cursor-pointer emp text-gray-400 hover:text-gray-500  ml-2">
                                            <i class="material-icons-round text-base">delete_outline</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.delete-user').on('click', function() {
            if ("{{ auth()->check() }}") {
                if ("{{ auth()->user()->role }}" == 'superadmin') {
                    const id = $(this).attr('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete('/user/' + id)
                                .then(function(res) {
                                    Swal.fire(
                                        'Deleted!',
                                        'User has been deleted.',
                                        'success'
                                    )
                                    window.location.reload();
                                })
                                .catch(function(err) {
                                    Swal.fire(
                                        'Failed!',
                                        'User not deleted.',
                                        'error'
                                    )
                                    window.location.reload();
                                })
                        }
                    })
                } else {
                    alert("You are not allowed to delete")
                }
            }
        })
    </script>
</x-app-layout>
