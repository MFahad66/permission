<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message>

            </x-message>
           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{route('permissions.create')}}" class="inline-flex items-center px-4 pt-2 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4 float-right mb-4">
                    Add Permission
                </a>
                <div class="p-6 text-gray-900">
                    <!-- Table with border and styling -->
                    <table class="w-full bg-white border border-gray-300 rounded-md shadow-sm">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-500">ID</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-500">Permission Name</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-500">Created </th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-500">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-900">{{$permission->id}}</td>
                                <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-900">{{$permission->name}}</td>
                                <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-900">{{$permission->created_at}}</td>
                                <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-900">
                                    <!-- Action Buttons (Edit and Delete) -->
                                    <div class="flex space-x-2">
                                        
                                        <a href="{{ route('permissions.edit', $permission->id) }}" style="display: inline-flex; padding: 8px 16px; background-color: rgb(85, 85, 180); color: white; border-radius: 4px;">
                                            Edit
                                        </a>

                                        <a href="javascript:void(0);" 
                                        onclick="deletePermission({{ $permission->id }});" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Del
                                     </a>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        function deletePermission(id) {
            if (confirm("Are you sure you want to delete this permission?")) {
                $.ajax({
                    url: "{{ route('permissions.destroy', ':id') }}".replace(':id', id),
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.status) {
                            alert('Permission deleted successfully!');
                            window.location.href = '{{ route("permissions.list") }}';
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        alert('An error occurred. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    </script>
</x-app-layout>
