<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('transactions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Transaction
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Month/Year Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('dashboard') }}" class="flex gap-4 items-end">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Month</label>
                            <select name="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Year</label>
                            <select name="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @for($y = now()->year; $y >= now()->year - 5; $y--)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Filter
                        </button>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Income Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Income</p>
                                <p class="text-2xl font-bold text-green-600">₦{{ number_format($income, 2) }}</p>
                            </div>
                            <div class="text-4xl">💰</div>
                        </div>
                    </div>
                </div>

                <!-- Expense Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Expense</p>
                                <p class="text-2xl font-bold text-red-600">₦{{ number_format($expense, 2) }}</p>
                            </div>
                            <div class="text-4xl">💸</div>
                        </div>
                    </div>
                </div>

                <!-- Balance Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Balance</p>
                                <p class="text-2xl font-bold {{ $balance >= 0 ? 'text-blue-600' : 'text-red-600' }}">
                                    ₦{{ number_format($balance, 2) }}
                                </p>
                            </div>
                            <div class="text-4xl">{{ $balance >= 0 ? '📊' : '⚠️' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Expense by Category -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Expenses by Category</h3>
                        @if($expenseByCategory->count() > 0)
                            <div style="position: relative; height: 300px;">
                                <canvas id="expenseChart"></canvas>
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No expense data for this month</p>
                        @endif
                    </div>
                </div>

                <!-- 6 Month Trend -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">6 Month Trend</h3>
                        <div style="position: relative; height: 300px;">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Recent Transactions</h3>
                        <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-900">View All</a>
                    </div>

                    @if($recentTransactions->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentTransactions as $transaction)
                                <div class="flex items-center justify-between border-b pb-3">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">{{ $transaction->category->icon ?? '📝' }}</span>
                                        <div>
                                            <p class="font-semibold">{{ $transaction->category->name }}</p>
                            <p class="text-sm text-gray-600">{{ $transaction->date->format('M d, Y') }}</p>
                                            @if($transaction->description)
                                                <p class="text-sm text-gray-500">{{ Str::limit($transaction->description, 40) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold {{ $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $transaction->type == 'income' ? '+' : '-' }}₦{{ number_format($transaction->amount, 2) }}
                                        </p>
                                        <span class="text-xs px-2 py-1 rounded {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No transactions yet. Add your first transaction!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Expense by Category Chart
        @if($expenseByCategory->count() > 0)
        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
        new Chart(expenseCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($expenseByCategory->pluck('category.name')) !!},
                datasets: [{
                    data: {!! json_encode($expenseByCategory->pluck('total')) !!},
                    backgroundColor: {!! json_encode($expenseByCategory->pluck('category.color')) !!},
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
        @endif

        // 6 Month Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(collect($monthlyTrend)->pluck('month')) !!},
                datasets: [
                    {
                        label: 'Income',
                        data: {!! json_encode(collect($monthlyTrend)->pluck('income')) !!},
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Expense',
                        data: {!! json_encode(collect($monthlyTrend)->pluck('expense')) !!},
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
