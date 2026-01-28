# Laravel Expense Tracker 💰

A personal finance management application built with Laravel 12, featuring interactive charts, category management, and comprehensive financial reports.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![Chart.js](https://img.shields.io/badge/Chart.js-4.x-orange)

## 🚀 Features

- 💵 **Income & Expense Tracking** - Track all your financial transactions
- 📊 **Interactive Charts** - Visualize expenses by category (doughnut chart) and 6-month trends (line chart)
- 🏷️ **Smart Categories** - Color-coded categories with emoji icons
- 📅 **Date Filtering** - Filter by month/year to analyze spending patterns
- 💡 **Real-time Balance** - Automatic calculation of income, expenses, and balance
- 🔍 **Advanced Filtering** - Filter transactions by type, category, and date range
- 🎨 **Beautiful UI** - Modern, responsive design with Tailwind CSS
- 🔐 **Secure Authentication** - User registration and login with Laravel Breeze

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Authentication:** Laravel Breeze
- **Database:** MySQL
- **Frontend:** Blade Templates + Tailwind CSS
- **Charts:** Chart.js
- **PHP Version:** 8.3+

## 📦 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL
- Node.js & NPM

### Setup

1. **Clone the repository**
```bash
   git clone https://github.com/papilamurie/expense-tracker.git
   cd expense-tracker
```

2. **Install dependencies**
```bash
   composer install
   npm install
```

3. **Environment setup**
```bash
   cp .env.example .env
   php artisan key:generate
```

4. **Configure database** (Edit `.env`)
```env
   DB_DATABASE=expense_tracker
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
   php artisan migrate
```

6. **Seed default categories**
```bash
   php artisan db:seed --class=CategorySeeder
```

7. **Build assets**
```bash
   npm run build
```

8. **Start the server**
```bash
   php artisan serve
```

Visit: http://localhost:8000



## 🎯 Usage

1. **Register** an account
2. **Add categories** or use the pre-seeded ones
3. **Track transactions** - Add income and expenses
4. **View dashboard** - See your financial overview with charts
5. **Filter & analyze** - Use filters to understand your spending patterns

## 📁 Project Structure
```
expense-tracker/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── TransactionController.php
│   │   └── CategoryController.php
│   └── Models/
│       ├── Transaction.php
│       ├── Category.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── CategorySeeder.php
└── resources/views/
    ├── dashboard.blade.php
    ├── transactions/
    └── categories/
```

## 🔒 Security

- CSRF protection on all forms
- User authentication required
- Users can only access their own data
- SQL injection protection via Eloquent ORM
- Password hashing with bcrypt

## 🚧 Future Enhancements

- [ ] Export transactions to CSV/PDF
- [ ] Recurring transactions
- [ ] Budget planning and alerts
- [ ] Multi-currency support
- [ ] Mobile app
- [ ] Receipt upload and OCR

## 📄 License

Open-source software licensed under the [MIT license](LICENSE).

## 👤 Author

**Your Name**
- GitHub: [@papilamurie](https://github.com/papilamurie)

---

⭐ If you found this project helpful, please give it a star!
