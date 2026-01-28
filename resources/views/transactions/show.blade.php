<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transaction Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('transactions.edit', $transaction) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('transactions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        <!-- Type & Amount -->
                        <div class="text-center border-b pb-6">
                            <span class="inline-block px-4 py-2 text-sm rounded mb-3 {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                            <h3 class="text-4xl font-bold {{ $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type == 'income' ? '+' : '-' }}₦{{ number_format($transaction->amount, 2) }}
                            </h3>
                        </div>

                        <!-- Category -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Category</h4>
                            <div class="flex items-center gap-2">
                                <span class="text-3xl">{{ $transaction->category->icon ?? '📝' }}</span>
                                <div>
                                    <p class="text-lg font-semibold">{{ $transaction->category->name }}</p>
                                    <span class="inline-block px-2 py-1 text-xs rounded"
                                        style="background-color: {{ $transaction->category->color }}22; color: {{ $transaction->category->color }};">
                                        {{ ucfirst($transaction->category->type) }} Category
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Date -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Date</h4>
                            <p class="text-lg">📅 {{ $transaction->date->format('F d, Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $transaction->date->diffForHumans() }}</p>
                        </div>

                        <!-- Description -->
                        @if($transaction->description)
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Description</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $transaction->description }}</p>
                            </div>
                        @endif

                        <!-- Metadata -->
                        <div class="border-t pt-4">
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <strong>Created:</strong> {{ $transaction->created_at->format('M d, Y h:i A') }}
                                </div>
                                <div>
                                    <strong>Last Updated:</strong> {{ $transaction->updated_at->format('M d, Y h:i A') }}
                                </div>
                            </div>
                        </div>

                        <!-- Delete Action -->
                        <div class="border-t pt-4">
                            <form method="POST" action="{{ route('transactions.destroy', $transaction) }}"
                                onsubmit="return confirm('Are you sure you want to delete this transaction? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete Transaction
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
