# 🛍️ E-commerce Admin Panel

An advanced **E-commerce Admin Panel** designed for managing products, users, discounts, inventory, and more. This admin panel is designed to provide full control over the online store while maintaining a clean, user-friendly interface.

---

## 🚀 Features

### 🧑‍💻 Admin Panel

The admin panel is equipped with everything you need to manage your online store efficiently:

- **Product Management**: Add, edit, and delete products. Include price, stock, categories, and images.
- **Post Management**: Manage blog posts for promotions, updates, or news.
- **Comment Management**: View and manage user comments on blog posts or product reviews.
- **Discount Management**: Create and manage discounts, promo codes, and special offers.
- **Ticket System**: Manage customer inquiries, complaints, and support tickets.
- **Inventory System**: Real-time inventory tracking, including stock adjustments and alerts.
- **Role-Based Access Control (RBAC)**: Assign and manage roles for admins and users (e.g., super admin, manager, etc.).

### ⚙️ Settings

- **Advanced Settings**: Configure store preferences, payment gateways, shipping methods, and more.
- **SEO Settings**: Manage meta tags, SEO-friendly URLs, and slug generation.
- **Customizable Themes**: Manage themes and branding (logos, banners) of the store.

### 📦 Product & Inventory Management

- **Products**: Manage product descriptions, prices, variants (sizes, colors), and more.
- **Stock**: Track stock levels, mark items as out of stock, and manage product restocks.
- **Images**: Integrated image upload service for product images and galleries.
  
### 📣 Notifications

- **Email Notifications**: Send email notifications to users for order updates, promotional offers, and more.
- **SMS Notifications**: Notify users about order status and promotions.

---

## 🧑‍💻 Admin Dashboard

| Feature             | Description                                                 |
|---------------------|-------------------------------------------------------------|
| 🛒 Products          | Manage product details, including prices, categories, and images |
| 📑 Posts             | Create and manage blog posts related to products and promotions |
| 💬 Comments          | Moderate and approve/reject user comments on products and posts |
| 🔖 Discounts         | Set up discount codes and limited-time offers               |
| 🎫 Tickets           | Handle customer support tickets and inquiries               |
| 📦 Inventory         | Real-time stock management with alerts for low stock        |
| 👥 User Roles        | Admin panel to assign user roles and permissions            |

---

## 🔧 Setup Instructions

To set up the project locally, follow these steps:

```bash
# Clone the repository
git clone https://github.com/ashkanrabiee/admin_panel_laravel.git
cd ecommerce-admin-panel

# Install dependencies
composer install
npm install && npm run dev

# Set up .env file
cp .env.example .env
php artisan key:generate

# Migrate the database
php artisan migrate --seed

# Start the local development server
php artisan serve

🤝 Contributing
Feel free to fork this repository, contribute via pull requests, or create an issue if you find bugs or want to suggest improvements.

📝 License
This project is licensed under the MIT License.
