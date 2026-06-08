# FOOD DELIVERY SYSTEM

## Cover Page

| Field | Details |
|-------|---------|
| STUDENT NAME | SWALHA MOHAMEDI |
| REGISTRATION NUMBER | 14325007/T.24 |
| PROGRAMME | Bsc. EDU-(MICT) |

---

## Project Overview

The Food Delivery System is a comprehensive web application designed to facilitate online food ordering and delivery services. This system provides a platform for customers to browse restaurants, place orders, and track deliveries in real-time.

## Features

- User authentication and account management
- Restaurant browsing and menu viewing
- Shopping cart functionality
- Order placement and tracking
- Delivery management
- Payment processing
- Review and rating system
- Admin dashboard for restaurant management

## Technology Stack

- Backend: PHP
- Frontend: CSS, HTML
- Database: MySQL
- Server: Apache

## Project Structure

```
FOOD_DELIVERY_SYSTEM/
├── index.php
├── css/
│   └── styles.css
├── includes/
│   ├── config.php
│   ├── header.php
│   └── footer.php
├── pages/
│   ├── home.php
│   ├── restaurants.php
│   ├── menu.php
│   ├── cart.php
│   ├── checkout.php
│   └── order-tracking.php
├── admin/
│   ├── dashboard.php
│   ├── manage-restaurants.php
│   └── manage-orders.php
└── README.md
```

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/swalhamohamedi/FOOD_DELIVERY_SYSTEM.git
   ```

2. Navigate to the project directory:
   ```
   cd FOOD_DELIVERY_SYSTEM
   ```

3. Set up the database:
   - Create a MySQL database
   - Import the database schema from the database backup file

4. Configure the database connection:
   - Update `includes/config.php` with your database credentials

5. Start your local server:
   - Use Apache or any PHP-compatible server
   - Access the application through `http://localhost/FOOD_DELIVERY_SYSTEM`

## Usage

- Open the application in your web browser
- Browse available restaurants and menus
- Add items to your cart
- Proceed to checkout and place an order
- Track your order in real-time

## Database Schema

The system uses a relational database with the following main tables:
- Users
- Restaurants
- Menu Items
- Orders
- Deliveries
- Reviews and Ratings

## API Endpoints

Key endpoints for the Food Delivery System:
- `GET /api/restaurants` - Retrieve all restaurants
- `GET /api/menu/{id}` - Get menu for a specific restaurant
- `POST /api/orders` - Create a new order
- `GET /api/orders/{id}` - Get order status
- `POST /api/reviews` - Submit a review

## Contributing

Contributions are welcome! To contribute:
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is open source and available under the MIT License.

## Support

For support or questions, please contact:
- Email: swalha.mohamedi@example.com
- GitHub Issues: [GitHub Issues](https://github.com/swalhamohamedi/FOOD_DELIVERY_SYSTEM/issues)

## Version History

- v1.0.0 - Initial release

---

Last Updated: June 8, 2026
