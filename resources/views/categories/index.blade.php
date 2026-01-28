<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Income Categories -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-green-600">💰 Income Categories</h3>

                        @if(isset($categories['income']) && $categories['income']->count() > 0)
                            <div class="space-y-3">
                                @foreach($categories['income'] as $category)
                                    <div class="flex items-center justify-between p-3 border rounded-lg hover:shadow-md transition-shadow">
                                        <div class="flex items-center gap-3">
                                            <span class="text-2xl">{{ $category->icon ?? '📝' }}</span>
                                            <div>
                                                <p class="font-semibold">{{ $category->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $category->transactions_count }} transaction(s)</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="w-6 h-6 rounded-full" style="background-color: {{ $category->color }}"></span>
                                            <div class="flex gap-2">
                                                <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No income categories yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Expense Categories -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-red-600">💸 Expense Categories</h3>

                        @if(isset($categories['expense']) && $categories['expense']->count() > 0)
                            <div class="space-y-3">
                                @foreach($categories['expense'] as $category)
                                    <div class="flex items-center justify-between p-3 border rounded-lg hover:shadow-md transition-shadow">
                                        <div class="flex items-center gap-3">
                                            <span class="text-2xl">{{ $category->icon ?? '📝' }}</span>
                                            <div>
                                                <p class="font-semibold">{{ $category->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $category->transactions_count }} transaction(s)</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="w-6 h-6 rounded-full" style="background-color: {{ $category->color }}"></span>
                                            <div class="flex gap-2">
                                                <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No expense categories yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
