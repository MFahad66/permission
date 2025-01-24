<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form for editing a role -->
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="grid grid-cols-4 gap-4">
                            <!-- Label and input field for Role Name -->
                            <div class="col-span-4 sm:col-span-1">
                                <label for="role_name" class="block text-sm font-medium text-gray-700">Role Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Enter role name"
                                    required
                                    value="{{ old('name', $role->name) }}"
                                />
                                @error('name')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Permissions checkbox group -->
                            <div class="col-span-4 sm:col-span-1">
                                <label for="permissions" class="block text-sm font-medium text-gray-700">Permissions</label>
                                <div class="mt-2">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center">
                                            <input 
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->name }}"
                                                id="permission_{{ $permission->id }}"
                                                class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                                {{ in_array($permission->name, $hasPermissions->toArray()) ? 'checked' : '' }}
                                            />
                                            <label for="permission_{{ $permission->id }}" class="ml-2 text-sm text-gray-600">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="inline-flex items-center px-4 pt-2 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
                            Update Role
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
