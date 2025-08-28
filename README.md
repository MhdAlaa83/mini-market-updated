🛒 **Mini Market (Laravel App)**
A simple Laravel-based mini market management app where you can:
   ➕ Add new products
   📋 View all products with pagination
   🔎 Search, filter, and sort products
   ✏️ Edit and update product details
   👁 View individual product details
   🖼 Upload images for products (with default placeholder support)
   🎨 Category-based color badges for better visualization
<hr>

**🚀 Features**

    Product CRUD (create, read, update)
    Image upload & storage in storage/app/public/products with automatic public access (php artisan storage:link)
    Default placeholder image for products without an image
    Search & filters (by name, category, price range)
    Sorting (newest, oldest, name, price)
    Category color badges (Snacks, Beverages, Groceries, Household, Personal Care, etc.)
    Bootstrap 5 styling with consistent, responsive product cards.
<hr>

**🛠 Requirements**
    PHP >= 8.1
    Composer
    MySQL
    Laravel 12.x
<hr>

🎨 **Screenshots**

Product Grid with Filters
<img width="683" height="579" alt="image" src="https://github.com/user-attachments/assets/9f1a5569-cbfb-47e9-a3c2-0444b0277a34" />
<hr>
<img width="671" height="588" alt="image" src="https://github.com/user-attachments/assets/c6a58f5f-9719-4617-9a57-c2ff4df9bf48" />
<hr>
Product Details
<img width="1074" height="359" alt="image" src="https://github.com/user-attachments/assets/f3170f0e-fa77-4b5d-aaa0-5fc87a8b659d" />

<hr>

**📦 Release Notes**

v0.3.0 — Authentication & Access Control
    ✨ Added User Sign Up page with validation (name, email, password confirmation).
    🔑 Added User Log In page with validation and “Remember me” option.
    🚪 Added Logout endpoint with CSRF protection.
    🔒 Restricted Add / Edit / Update Products to authenticated users only.
    👤 Updated navigation to show Sign Up / Login for guests, Add Product / Logout for signed-in users.

v0.2.0 — Cart System
    🛒 Added CartController with session-based cart storage.
    ➕ Added Add to Cart (POST form, quantity field).
    ✏️ Added Update Cart (change item quantities, set to 0 = remove).
    ❌ Added Remove from Cart and Clear Cart actions.
    💰 Added cart subtotal calculation and cart index page with table layout.

v0.1.1 — Product Enhancements
    📸 Implemented image uploads stored under storage/app/public/products.
    🔗 Added php artisan storage:link support for serving uploaded files via /storage/... URL.
    🖼️ Added default placeholder image for products without an uploaded image.
    🎨 Added category color badges (different Bootstrap colors for Snacks, Beverages, Groceries, etc.).
    🧹 Fixed image size consistency: all product images display in a fixed ratio using Bootstrap’s object-fit-contain.
    🔄 Added flash messages for all CRUD and cart actions.

v0.1.0 — Initial Release
    Basic CRUD: Create, List, Update products.
    Filters: category, min/max price.
    Search: by name/description.
    Sorting: by name, price, created date.
    Bootstrap 5 UI with soft theme colors.
<hr>

**📝 Future Improvements**
    ✅ Delete products
    ✅ Export product list (CSV / Excel)
    ✅ Authentication (Admin login)
    ✅ Category management

