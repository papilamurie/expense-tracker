<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Get the first user (you can modify this to seed for all users)
        $user = User::first();

        if (!$user) {
            $this->command->warn('No users found. Please register a user first.');
            return;
        }

        $categories = [
            // Income Categories
            ['name' => 'Salary', 'type' => 'income', 'color' => '#10b981', 'icon' => '💰'],
            ['name' => 'Freelance', 'type' => 'income', 'color' => '#3b82f6', 'icon' => '💼'],
            ['name' => 'Investment', 'type' => 'income', 'color' => '#8b5cf6', 'icon' => '📈'],
            ['name' => 'Gift', 'type' => 'income', 'color' => '#ec4899', 'icon' => '🎁'],
            ['name' => 'Other Income', 'type' => 'income', 'color' => '#06b6d4', 'icon' => '💵'],

            // Expense Categories
            ['name' => 'Food & Dining', 'type' => 'expense', 'color' => '#f59e0b', 'icon' => '🍔'],
            ['name' => 'Transportation', 'type' => 'expense', 'color' => '#ef4444', 'icon' => '🚗'],
            ['name' => 'Shopping', 'type' => 'expense', 'color' => '#ec4899', 'icon' => '🛍️'],
            ['name' => 'Entertainment', 'type' => 'expense', 'color' => '#8b5cf6', 'icon' => '🎬'],
            ['name' => 'Bills & Utilities', 'type' => 'expense', 'color' => '#6366f1', 'icon' => '💡'],
            ['name' => 'Health & Fitness', 'type' => 'expense', 'color' => '#10b981', 'icon' => '🏥'],
            ['name' => 'Education', 'type' => 'expense', 'color' => '#3b82f6', 'icon' => '📚'],
            ['name' => 'Rent', 'type' => 'expense', 'color' => '#f97316', 'icon' => '🏠'],
            ['name' => 'Other Expense', 'type' => 'expense', 'color' => '#64748b', 'icon' => '💸'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'user_id' => $user->id,
                'name' => $category['name'],
                'type' => $category['type'],
                'color' => $category['color'],
                'icon' => $category['icon'],
            ]);
        }

        $this->command->info('Categories seeded successfully!');
    }
}
