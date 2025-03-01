# 📌 Laravel Livewire E-Commerce Project

## 🚀 Overview
This project is a **single-page product listing application** with a **real-time shopping cart** built using:
- **Laravel 12** (Backend)
- **Livewire v3** (Reactivity & Real-time UI updates)
- **Alpine.js** (Frontend Interactivity)
- **Tailwind CSS** (Modern Styling)
- **MySQL** (Database for Products & Cart Management)

It supports **1,000,000+ products**, optimized queries, and real-time cart updates across multiple devices.

---

## 📦 Features
### ✅ **Products Page**
- Displays a **grid of products** with name, price, image, and "Add to Cart" button.
- Uses **efficient pagination** to handle large datasets.
- Dynamically updates the **Add to Cart button** to show increment (`+`) and decrement (`-`) buttons when a product is in the cart.

### ✅ **Real-Time Cart**
- **Database-backed cart system** (persists across multiple devices).
- Uses **Livewire events (`dispatch('cartUpdated')`)** for **instant updates**.
- Supports **removing products** from the cart dynamically.
- Displays cart summary (total price, product names, and quantities).

### ✅ **Frontend Interactivity**
- **Alpine.js for cart modal toggling**.
- **Tailwind CSS for a clean, modern, and responsive UI**.

### ✅ **Performance & Optimization**
- **Indexing (`$table->index()`)** for fast product & cart queries.
- **Eager loading (`with()`)** to prevent `N+1` query issues.
- **Pagination (`paginate(20)`)** to avoid memory overload.
- **Batching (`chunk(5000)`) for seeding 1M+ products efficiently**.
- **Efficient seeding strategies (`batch insert every 5000 records`)** ensure smooth execution.

---

## 📂 Installation Guide
### 🔹 **Step 1: Clone the Repository**
```bash
git clone https://github.com/your-username/ecommerce-livewire.git
cd ecommerce-livewire
```

### 🔹 **Step 2: Install Dependencies**
```bash
composer install
npm install
```

### 🔹 **Step 3: Set Up Environment**
Copy the `.env.example` file and update database credentials:
```bash
cp .env.example .env
```
Then update **database settings** inside `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

### 🔹 **Step 4: Run Migrations & Seeders**
```bash
php artisan migrate --seed
```
This will **create database tables** and **seed 1,000,000 products** efficiently using **batch processing**.

### 🔹 **Step 5: Start Development Server**
```bash
php artisan serve
```
Then open **http://127.0.0.1:8000** in your browser.

---

## ⚡ Optimization Notes
- **Indexes added** on `products.name`, `products.price`.
- **Batch seeding (5000 records per batch) ensures smooth product insertion.**

---

## 👥 Contributors
- **Khaled Moussa** (khaledmoussaeid@gmail.com)
---

## 📜 License
This project is open-source and available under the **MIT License**.

---

🎯 **Now you're ready to build and test your Laravel Livewire e-commerce app! 🚀**
