<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Get current month and year
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        // Calculate totals for selected month
        $income = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->forMonth($month, $year)
            ->sum('amount');

        $expense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->forMonth($month, $year)
            ->sum('amount');

        $balance = $income - $expense;

        // Get recent transactions
        $recentTransactions = Transaction::where('user_id', $userId)
            ->with('category')
            ->latest('date')
            ->latest('id')
            ->take(10)
            ->get();

        // Get expense by category for chart
        $expenseByCategory = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->forMonth($month, $year)
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->with('category')
            ->groupBy('category_id')
            ->get();

        // Get monthly trend (last 6 months)
        $monthlyTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyIncome = Transaction::where('user_id', $userId)
                ->where('type', 'income')
                ->forMonth($date->month, $date->year)
                ->sum('amount');

            $monthlyExpense = Transaction::where('user_id', $userId)
                ->where('type', 'expense')
                ->forMonth($date->month, $date->year)
                ->sum('amount');

            $monthlyTrend[] = [
                'month' => $date->format('M Y'),
                'income' => $monthlyIncome,
                'expense' => $monthlyExpense,
            ];
        }

        return view('dashboard', compact(
            'income',
            'expense',
            'balance',
            'recentTransactions',
            'expenseByCategory',
            'monthlyTrend',
            'month',
            'year'
        ));
    }
}
