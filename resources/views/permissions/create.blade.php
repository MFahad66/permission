<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form with a 4-column grid -->
                    <form action="{{route('permissions.store')}}" method="POST">
                        @csrf
                        <div class="grid grid-cols-4 gap-4">
                            <!-- Label and input field for Permission Name -->
                            <div class="col-span-4 sm:col-span-1">
                                <label for="permission_name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Enter permission name"
                                    required
                                    value="{{old('name')}}"
                                />
                                @error('name')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="inline-flex items-center px-4 pt-2 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
                            Add 
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
