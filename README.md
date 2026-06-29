````markdown
# 📦 Inventory Pro Management

A modern **Inventory Management & Point of Sale (POS)** system built with **Laravel 10**, designed to help businesses efficiently manage inventory, sales, customers, employees, suppliers, expenses, and payroll from a single dashboard.

---

## 🚀 Overview

Inventory Pro Management is a feature-rich web application that simplifies day-to-day business operations. It combines inventory management, sales processing, employee management, financial tracking, and reporting into one responsive and user-friendly platform.

Whether you're running a retail shop, wholesale business, or small enterprise, this system helps streamline workflows and improve productivity.

---

## ✨ Key Features

### 📦 Product Management
- Full CRUD operations
- Product image upload
- Category & supplier filtering
- Search by product name or code
- Low stock highlighting

### 🗂 Category Management
- CRUD operations
- Active/Inactive toggle
- Only active categories appear in product forms

### 👥 Customer Management
- Full CRUD operations
- Automatically tracks total purchases

### 🚚 Supplier Management
- Full CRUD operations

### 👨‍💼 Employee Management
- Full CRUD operations
- Automatically creates linked user account
- Employee role assignment
- Profile picture upload
- Salary tracking

### 💰 Expense Management
- CRUD operations
- Filter by category
- Filter by date range

### 💵 Salary Management
- Monthly salary records
- Duplicate prevention
- Mark salary as paid
- Payment timestamp

---

# 🛒 Point of Sale (POS)

The integrated POS system provides a smooth and efficient checkout experience.

### Features

- AJAX product search
- Product grid display
- Session-based shopping cart
- Add, update, remove, or clear cart
- Customer selection
- Automatic 15% VAT calculation
- Multiple payment methods
  - Cash
  - Bank
  - Mobile Banking
- Unique invoice generation
- Automatic stock deduction
- Due amount tracking
- Invoice details page

---

# 📋 Order Management

- View all orders
- Filter by status
- Filter by date range
- Update order status
- Delete orders
- Automatically restore stock after order deletion

Supported statuses:

- Pending
- Completed
- Cancelled

---

# 📊 Reports & Analytics

## Dashboard

- Today's Sales
- Total Sales
- Customers
- Orders
- Products
- Categories
- Suppliers
- Employees
- Expenses
- Monthly Sales Chart (Chart.js)
- Recent Orders Table

## Sales Report

Generate reports by:

- Daily
- Monthly
- Yearly
- Custom Date Range

Export reports to **Excel (.xlsx)**.

## Profit & Loss Report

Displays:

- Revenue
- Expenses
- Net Profit

within any selected date range.

---

# 🔍 Global Search

Real-time AJAX search across:

- Products
- Customers
- Orders

Accessible from anywhere in the application.

---

# 🔐 Authentication & Security

- User Authentication
- Login & Registration
- Email Verification
- Password Reset
- Password Confirmation
- Role-Based Access Control

Roles:

- Admin
- Employee

---

# 🎨 User Interface

- Dark Theme
- Responsive Design
- Mobile Friendly
- Tailwind CSS
- Alpine.js
- Font Awesome 6
- Animated Sidebar
- Flash Messages
- Delete Confirmation Dialogs

---

# 🌱 Demo Data

The application comes with seeded demo data including:

- Admin
- Employees
- Customers
- Suppliers
- Categories
- Products
- Orders
- Expenses
- Salaries

---

# 🛠 Built With

| Technology | Version |
|------------|---------|
| Laravel | 10 |
| PHP | 8.x |
| Tailwind CSS | Latest |
| Alpine.js | Latest |
| Chart.js | Latest |
| MySQL | 8.x |
| JavaScript | ES6 |
| HTML5 | ✓ |
| CSS3 | ✓ |

---

# 📈 Business Benefits

## For Business Owners

- Centralized inventory management
- Real-time business insights
- Automated stock tracking
- Sales monitoring
- Expense management
- Employee payroll management
- Customer tracking
- Excel export for accounting
- Better business decision making

## For Cashiers & Employees

- Fast POS experience
- Quick product search
- Automatic VAT calculation
- Multiple payment methods
- Responsive interface
- Global search functionality

## For Everyone

- Secure role-based access
- Easy-to-use interface
- Dark mode for reduced eye strain
- Comprehensive reporting
- Reduced manual work

---

# 📂 Project Structure

```
Inventory Pro Management
├── Products
├── Categories
├── Customers
├── Suppliers
├── Employees
├── Expenses
├── Salaries
├── POS
├── Orders
├── Reports
├── Dashboard
└── Authentication
```

---

# ⚙️ Installation

```bash
# Clone repository
git clone https://github.com/yourusername/inventory-pro-management.git

# Go to project folder
cd inventory-pro-management

# Install dependencies
composer install

npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env

# Run migrations
php artisan migrate

# Seed demo data
php artisan db:seed

# Create storage link
php artisan storage:link

# Start development server
php artisan serve

# Build frontend assets
npm run dev
```

---

# 🔑 Default Admin Login

> Update these credentials according to your seeded data.

```
Email:
admin@example.com

Password:
password
```

---

# 📸 Screenshots

You can add screenshots here.

- Dashboard
- POS
- Product Management
- Sales Report
- Profit & Loss Report

---

# 🤝 Contributing

Contributions, issues, and feature requests are welcome.

Feel free to fork the project and submit a Pull Request.

---

# 📄 License

This project is licensed under the MIT License.

---

# 👨‍💻 Author

**Khalid Hasan Shafi**

Laravel Developer

If you like this project, don't forget to ⭐ the repository.
````
