<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Category Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required placeholder="e.g., Groceries, Salary, etc.">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type *</label>
                            <select name="type" id="type"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">Select type</option>
                                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div class="mb-4">
                            <label for="color" class="block text-sm font-medium text-gray-700">Color *</label>
                            <div class="flex gap-4 items-center">
                                <input type="color" name="color" id="color" value="{{ old('color', '#3b82f6') }}"
                                    class="mt-1 h-10 w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                <span class="text-sm text-gray-600">Choose a color for this category</span>
                            </div>
                            @error('color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon (Emoji) -->
                        <div class="mb-4">
                            <label for="icon" class="block text-sm font-medium text-gray-700">Icon (Emoji)</label>
                            <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                maxlength="10" placeholder="e.g., 💰 🍔 🚗 🏠">
                            <p class="mt-1 text-xs text-gray-500">
                                Optional. Use an emoji to represent this category.
                                <a href="https://emojipedia.org/" target="_blank" class="text-blue-600 hover:text-blue-900">Find emojis</a>
                            </p>
                            @error('icon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div class="flex items-center gap-3">
                                <span id="preview-icon" class="text-2xl">📝</span>
                                <div>
                                    <p id="preview-name" class="font-semibold">Category Name</p>
                                    <span id="preview-badge" class="inline-block px-2 py-1 text-xs rounded" style="background-color: #3b82f622; color: #3b82f6;">
                                        <span id="preview-type">Type</span> Category
                                    </span>
                                </div>
                                <span id="preview-color" class="w-6 h-6 rounded-full ml-auto" style="background-color: #3b82f6;"></span>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Category
                            </button>
                            <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Live preview
        document.getElementById('name').addEventListener('input', function() {
            document.getElementById('preview-name').textContent = this.value || 'Category Name';
        });

        document.getElementById('type').addEventListener('change', function() {
            document.getElementById('preview-type').textContent = this.value || 'Type';
        });

        document.getElementById('color').addEventListener('input', function() {
            const color = this.value;
            document.getElementById('preview-color').style.backgroundColor = color;
            document.getElementById('preview-badge').style.backgroundColor = color + '22';
            document.getElementById('preview-badge').style.color = color;
        });

        document.getElementById('icon').addEventListener('input', function() {
            document.getElementById('preview-icon').textContent = this.value || '📝';
        });
    </script>
    @endpush
</x-app-layout>
