## Table of Contents
- [About The Project](#about-the-project)
- [Built With](#built-with)
- [Features](#features)
  - [Authentication & User Management](#authentication--user-management)
  - [Dashboard](#dashboard)
  - [Point of Sale (POS)](#point-of-sale-pos)
  - [Product Management](#product-management)
  - [Category Management](#category-management)
  - [Customer Management](#customer-management)
  - [Supplier Management](#supplier-management)
  - [Employee Management](#employee-management)
  - [Order Management](#order-management)
  - [Expense Management](#expense-management)
  - [Salary Management](#salary-management)
  - [Reports & Analytics](#reports--analytics)
  - [Global Search](#global-search)
- [User Benefits](#user-benefits)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Configuration](#configuration)
  - [Database Setup](#database-setup)
  - [Demo Data](#demo-data)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [License](#license)
---
## About The Project
**Inventory Pro Management** is a full-featured inventory management and point-of-sale (POS) application designed for small to medium retail businesses. It provides a unified platform to manage products, sales, customers, employees, suppliers, expenses, and payroll — all through a modern, responsive, dark-themed web interface.
The application streamlines day-to-day retail operations by combining inventory tracking, sales processing, financial reporting, and employee management into a single cohesive system. Built with **Laravel 10** on the backend and **Tailwind CSS** with **Alpine.js** on the frontend, it delivers a fast, intuitive experience across desktop and mobile devices.
---
## Built With
| Category | Technology |
|---|---|
| **Backend Framework** | [Laravel 10.x](https://laravel.com/) (PHP 8.1+) |
| **Frontend** | [Tailwind CSS](https://tailwindcss.com/), [Alpine.js](https://alpinejs.dev/), [Chart.js](https://www.chartjs.org/), [Font Awesome 6](https://fontawesome.com/) |
| **Authentication** | Laravel Jetstream 4.x, Laravel Fortify, Laravel Sanctum 3.x |
| **Database** | MySQL 8.0 |
| **ORM** | Eloquent ORM |
| **Templating** | Laravel Blade |
| **Excel Export** | [Maatwebsite/Laravel-Excel](https://docs.laravel-excel.com/) 3.x |
| **PDF Generation** | [Dompdf](https://github.com/dompdf/dompdf) 2.x |
| **HTTP Client** | GuzzleHTTP 7.x |
| **Testing** | PHPUnit 10, Laravel Dusk (optional) |
| **Dev Tools** | Laravel Sail (Docker), Laravel Pint (code style) |
---
## Features
### Authentication & User Management
- **User Registration** with email verification
- **Login / Logout** with session-based authentication
- **Password Reset** via email with token-based flow
- **Role-Based Access Control** — Two roles: `admin` and `employee`
- **Password Confirmation** for sensitive actions
- **Profile Avatar** display in the navigation sidebar
### Dashboard
The central analytics hub provides an at-a-glance overview of your entire business:
| Metric | Description |
|---|---|
| **Today's Sales** | Total sales for current day with percentage change vs. previous month |
| **Total Sales** | All-time aggregate sales revenue |
| **Total Customers** | Count of registered customers |
| **Total Orders** | Count of all orders placed |
| **Total Products** | Count of products in inventory |
| **Total Categories** | Count of product categories |
| **Total Suppliers** | Count of registered suppliers |
| **Total Employees** | Count of employees |
| **Total Expenses** | Aggregate expenses recorded |
| **Monthly Sales Chart** | Interactive line chart showing sales per month for the current year |
| **Recent Orders** | Last 5 orders with invoice number, customer, amount, status, and date |
### Point of Sale (POS)
A fast, intuitive POS interface designed for retail checkout:
- **Product Grid** with image thumbnails, product code, price, and real-time stock quantity
- **Low-Stock Alerts** — Products with critically low stock are highlighted in red
- **Real-Time Search** — AJAX-powered search by product name or code
- **Session-Based Shopping Cart**:
  - Add items to cart by clicking product cards
  - Update item quantities directly
  - Remove individual items or clear entire cart
- **Customer Selection** — Assign orders to registered customers
- **Automatic Calculations**:
  - Subtotal, 15% VAT (Value Added Tax), grand total
  - Paid amount and due amount computation
- **Multiple Payment Methods** — Cash, Bank Transfer, Mobile Payment
- **Invoice Generation** — Unique invoice number (`INV-XXXXXXXX`) with detailed breakdown
- **Auto Stock Decrement** — Product quantities reduced automatically on order placement
- **Customer Purchase Tracking** — `total_purchases` field auto-incremented per customer
- **Order Status** — Automatically set to `completed` (fully paid) or `pending` (has due)
### Product Management
Full CRUD operations for inventory items:
- **List all products** with search by name/code, filter by category and supplier
- **Create product** — Fields: name, unique code, category, supplier, quantity, unit cost, selling price, image upload (jpeg/png/jpg/gif, max 2MB)
- **Edit product** — Image replacement with automatic old image cleanup
- **View product** details
- **Delete product** — Associated image removed from server
- **Relationships** — Products belong to both Category and Supplier
### Category Management
Organize products into logical groups:
- **List all categories** with active/inactive status
- **Create category** — Name (unique), description, status (defaults to active)
- **Edit / View / Delete** categories
- **Toggle Status** — Quick activate/deactivate without full edit
- **Dropdown Filtering** — Only active categories appear in product creation forms
### Customer Management
Build and maintain your customer database:
- **List all customers** with auto-tracked total purchases
- **Create customer** — Name, email (unique), phone, address
- **Edit / View / Delete** customers
- **Purchase History** — `total_purchases` automatically updates when orders are placed
### Supplier Management
Manage your supply chain:
- **List all suppliers**
- **Create supplier** — Name, company name, phone, email, address
- **Edit / View / Delete** suppliers
### Employee Management
Manage staff accounts and profiles:
- **List all employees** with linked user account info
- **Create employee** — Creates both a `User` (role=employee) and `Employee` record; fields include name, email, password, phone, address, salary, join date, profile picture
- **Edit employee** — Updates both user profile and employee details; optional password change; optional profile picture replacement
- **View / Delete** employees — Deletion removes both user account and employee record with profile picture cleanup
### Order Management
Track and manage all sales transactions:
- **List all orders** with filters by status (pending / completed / cancelled) and date range
- **View order** details — Customer info, all order items, pricing breakdown
- **Update order status** — Toggle between pending, completed, cancelled
- **View Invoice** — Detailed invoice for any order
- **Delete order** — Automatically restores product quantities (increments stock back)
### Expense Management
Track business expenses:
- **List all expenses** with filter by category and date range; shows total amount filtered
- **Create expense** — Category, amount, date, description
- **Edit / View / Delete** expenses
### Salary Management
Manage employee payroll:
- **List all salaries** with filters by month/year and status (paid/pending)
- **Create salary record** — Select employee, month, year, amount, status
- **Duplicate Prevention** — Cannot create salary for the same employee/month/year combination twice
- **Edit / View / Delete** salary records
- **Pay Salary** — Mark salary as paid with auto-timestamp for payment date
- **Employee Salary Reference** — All employees displayed for quick reference
### Reports & Analytics
Generate detailed business reports:
- **Sales Report** with four view types:
  - **Daily** — Today's sales summary
  - **Monthly** — Current month's sales data
  - **Yearly** — Current year's sales aggregate
  - **Custom Date Range** — User-defined start and end dates
- **Report Summary Statistics**: Total orders, total sales, total expenses, net profit
- **Export to Excel (XLSX)**: Sales report exportable with columns: Invoice No, Customer, Total Amount, VAT, Paid Amount, Due Amount, Payment Method, Status, Date
- **Profit/Loss Report**: Date range selector comparing sales revenue vs. expenses with net profit calculation
### Global Search
A real-time AJAX-powered search bar accessible from any page:
- Searches across **Products** (by name or code), **Orders** (by invoice number), and **Customers** (by name, email, or phone) simultaneously
- Results grouped by type with icons and links to detail pages
- Minimum 2-character query with 300ms debounce and click-away-to-close behavior
### UI / UX
- **Dark Theme** — Custom Tailwind CSS dark color palette
- **Responsive Design** — Mobile-first, collapsible sidebar, adaptive grid layouts
- **Inter Font** from Google Fonts for clean typography
- **Font Awesome 6** icons throughout the interface
- **Alpine.js** for interactive UI (sidebar toggle, notification dropdown, etc.)
- **Chart.js** for dashboard analytics visualization
- **Flash Messages** — Success/error notifications displayed at top of content area
- **Confirmation Prompts** — Before destructive actions (deletions)
---
## User Benefits
### For Business Owners & Administrators
1. **Centralized Inventory Control** — Manage all products, categories, and suppliers from one dashboard, ensuring accurate stock tracking and reducing manual errors.
2. **Efficient Point of Sale** — The integrated POS system allows cashiers to process sales quickly with product search, automatic 15% VAT calculation, and multiple payment methods (cash/bank/mobile), speeding up checkout and minimizing transaction errors.
3. **Real-Time Business Intelligence** — The dashboard provides instant visibility into today's sales, total sales, customer counts, order volumes, product counts, and a 12-month sales trend chart — enabling data-driven decisions without manual reporting.
4. **Reduced Stock Loss** — Products in the POS decrement automatically on order placement. When orders are deleted or cancelled, stock is restored — maintaining perpetual inventory accuracy.
5. **Full Financial Tracking** — Track expenses (rent, utilities, supplies, etc.), employee salaries, and profit/loss across customizable date ranges, giving a complete picture of business financial health.
6. **Customer Relationship Management** — Maintain a customer directory with automatic tracking of total purchases per customer, enabling loyalty programs and targeted marketing.
7. **Supplier Management** — Keep supplier directories and link products to suppliers for streamlined reordering and supply chain management.
8. **Employee & Payroll Management** — Manage employee profiles, track salaries per month/year, mark payments as paid/pending, and prevent duplicate payments — simplifying payroll administration.
9. **Reporting & Compliance** — Generate sales reports filtered by daily/monthly/yearly/custom periods and export them to Excel for accounting, tax filing, and stakeholder reporting.
10. **Role-Based Security** — Employees can use the system with limited access while administrators retain full control over sensitive operations.
### For Employees & Cashiers
1. **Intuitive POS Interface** — The product grid with search, visual stock indicators, and cart system makes processing sales fast and straightforward.
2. **Quick Access** — The global search bar lets employees find products, orders, and customers instantly from any page without navigating through menus.
3. **Invoice Generation** — Generate and view detailed invoices for every transaction to provide to customers.
4. **Responsive Design** — Works on desktops, tablets, and phones, allowing flexibility in where and how the system is used.
5. **Session Persistence** — Shopping carts persist during the session, allowing for interrupted workflows.
### For Developers
1. **Modern Laravel Architecture** — PSR-4 autoloading, MVC pattern, Eloquent ORM, service providers, middleware, and route grouping — easy to extend and maintain.
2. **Well-Structured Codebase** — Separate Controllers for each domain, dedicated Model classes with relationships, Form Requests for validation, database Migrations, Seeders, and Exports organized into logical directories.
3. **Composer Dependencies** — All dependencies managed via Composer; easy to add new packages.
4. **Database Migrations** — Full schema versioning with migration files covering all tables, making setup reproducible across environments.
5. **Pre-Seeded Demo Data** — A comprehensive DatabaseSeeder with realistic sample data makes onboarding and development testing immediate.
---
## Getting Started
### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL 8.0+
- Node.js & NPM (optional, for frontend asset compilation)
- Web server (Apache / Nginx) or Laravel Valet / Sail
### Installation
1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/inventory-management-system.git
   cd inventory-management-system
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Copy environment file:**
   ```bash
   cp .env.example .env
   ```
4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
### Configuration
Edit the `.env` file with your database credentials and application settings:
```env
APP_NAME="Inventory Pro Management"
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=your_password
```
### Database Setup
1. **Create the database:**
   ```sql
   CREATE DATABASE inventory_db;
   ```
2. **Run migrations:**
   ```bash
   php artisan migrate
   ```
3. **(Optional) Seed demo data:**
   ```bash
   php artisan db:seed
   ```
### Demo Data
Running the seeder creates the following demo accounts and data:
| Type | Credentials |
|---|---|
| **Admin** | `admin@inventory.com` / `password` |
| **Employees** | 4 employee accounts with individual salary records |
| **Customers** | 5 customers |
| **Suppliers** | 3 suppliers |
| **Categories** | 5 categories |
| **Products** | 10 products |
| **Orders** | 15 sample orders with line items |
| **Expenses** | 5 expense records |
| **Salaries** | Salary records for all employees |
### Running the Application
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser.
---
## Usage
### Default Workflow
1. **Login** as admin or employee
2. **Dashboard** — View business overview and key metrics
3. **Add Products** — Populate inventory via Products section
4. **Set up Categories & Suppliers** — Organize products
5. **Process Sales** — Use the POS module to create orders
6. **Manage Customers** — Track customer information and purchase history
7. **Track Expenses** — Record business expenses
8. **Manage Employees & Salaries** — Handle payroll
9. **Generate Reports** — Analyze sales and profit/loss
---
## Project Structure
```
inventory-management-system/
├── app/
│   ├── Console/              # Artisan commands
│   ├── Exports/              # Excel export classes
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   │   ├── Auth/         # Authentication controllers
│   │   │   ├── CategoryController.php
│   │   │   ├── CustomerController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── EmployeeController.php
│   │   │   ├── ExpenseController.php
│   │   │   ├── OrderController.php
│   │   │   ├── POSController.php
│   │   │   ├── ProductController.php
│   │   │   ├── ReportController.php
│   │   │   ├── SalaryController.php
│   │   │   ├── SearchController.php
│   │   │   └── SupplierController.php
│   │   ├── Middleware/        # Custom middleware
│   │   ├── Requests/         # Form request validation
│   │   └── Resources/        # API resources
│   ├── Models/               # Eloquent models
│   └── Providers/            # Service providers
├── bootstrap/                # Laravel bootstrap files
├── config/                   # Configuration files
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/             # Database seeders
├── public/                   # Public assets (CSS, JS, images)
├── resources/
│   └── views/               # Blade templates
│       ├── admin/           # Admin panel views
│       ├── auth/            # Authentication views
│       ├── layouts/         # Layout templates
│       └── vendor/          # Third-party package views
├── routes/
│   ├── web.php              # Web routes
│   ├── api.php              # API routes
│   └── auth.php             # Authentication routes
├── storage/                  # Storage (logs, cache, uploads)
├── composer.json
└── package.json
```
---
## Database Schema
The application uses the following database tables (managed via Laravel migrations):
| Table | Purpose |
|---|---|
| `users` | User accounts (admin & employees) |
| `employees` | Employee profiles (linked to users) |
| `categories` | Product categories |
| `suppliers` | Supplier information |
| `products` | Inventory items |
| `customers` | Customer records |
| `orders` | Sales orders |
| `order_details` | Individual line items within orders |
| `expenses` | Business expense records |
| `salaries` | Employee salary records |
| `sessions` | User sessions |
| `personal_access_tokens` | API tokens (Sanctum) |
| `password_reset_tokens` | Password reset tokens |
| `failed_jobs` | Failed queue jobs |
| `notifications` | Notifications table |
---
## API Endpoints
### Authentication Routes
| Method | Endpoint | Description |
|---|---|---|
| GET | `/login` | Login page |
| POST | `/login` | Authenticate user |
| POST | `/logout` | Logout user |
| GET | `/register` | Registration page |
| POST | `/register` | Create new account |
| GET | `/forgot-password` | Password reset request page |
| POST | `/forgot-password` | Send password reset link |
| GET | `/reset-password/{token}` | Password reset form |
| POST | `/reset-password` | Reset password |
### Web Routes
| Method | Endpoint | Description |
|---|---|---|
| GET | `/dashboard` | Dashboard home |
| GET | `/pos` | Point of Sale interface |
| POST | `/pos/add-cart` | Add item to cart |
| POST | `/pos/update-cart/{rowId}` | Update cart item quantity |
| DELETE | `/pos/delete-cart/{rowId}` | Remove item from cart |
| POST | `/pos/invoice` | Generate and store order |
| GET | `/pos/invoice/{orderId}` | View invoice |
| GET | `/products` | List products |
| POST | `/products` | Create product |
| GET | `/products/create` | Product creation form |
| GET | `/products/{product}` | View product |
| PUT | `/products/{product}` | Update product |
| DELETE | `/products/{product}` | Delete product |
| GET | `/products/{product}/edit` | Edit product form |
| GET | `/categories` | List categories |
| POST | `/categories` | Create category |
| GET | `/categories/create` | Category creation form |
| GET | `/categories/{category}` | View category |
| PUT | `/categories/{category}` | Update category |
| DELETE | `/categories/{category}` | Delete category |
| GET | `/categories/{category}/edit` | Edit category form |
| PUT | `/categories/{category}/status` | Toggle category status |
| GET | `/customers` | List customers |
| ... | `/customers/*` | Full CRUD for customers |
| GET | `/suppliers` | List suppliers |
| ... | `/suppliers/*` | Full CRUD for suppliers |
| GET | `/employees` | List employees |
| ... | `/employees/*` | Full CRUD for employees |
| GET | `/orders` | List orders |
| GET | `/orders/{order}` | View order details |
| PUT | `/orders/{order}/status` | Update order status |
| DELETE | `/orders/{order}` | Delete order |
| GET | `/orders/{order}/invoice` | View order invoice |
| GET | `/expenses` | List expenses |
| ... | `/expenses/*` | Full CRUD for expenses |
| GET | `/salaries` | List salaries |
| ... | `/salaries/*` | Full CRUD for salaries |
| PUT | `/salaries/{salary}/pay` | Mark salary as paid |
| GET | `/reports/sales` | Sales report page |
| GET | `/reports/profit-loss` | Profit/loss report page |
| GET | `/search` | Global search (AJAX) |
---
## Contributing
Contributions are welcome! Please follow these steps:
1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request
### Coding Standards
- Follow PSR-12 coding standards
- Use Laravel Pint for code style formatting: `./vendor/bin/pint`
- Write unit/feature tests for new functionality
- Maintain the existing MVC pattern and naming conventions
---
## License
Distributed under the MIT License. See `LICENSE` file for more information.
---
<p align="center">
  Built with ❤️ using <a href="https://laravel.com/">Laravel</a>
</p>
