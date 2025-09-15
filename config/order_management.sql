CREATE DATABASE IF NOT EXISTS order_management;
USE order_management;

CREATE TABLE brands (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE categories (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL,
    description TEXT COLLATE utf8mb4_general_ci DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE orders (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) DEFAULT NULL,
    order_date DATE DEFAULT NULL,
    status VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    total DECIMAL(10,2) DEFAULT NULL,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE order_details (
    id INT(11) NOT NULL AUTO_INCREMENT,
    product_id INT(11) DEFAULT NULL,
    order_id INT(11) DEFAULT NULL,
    quantity INT(11) DEFAULT NULL,
    unit_price DECIMAL(10,2) DEFAULT NULL,
    PRIMARY KEY (id),
    KEY product_id (product_id),
    KEY order_id (order_id),
    CONSTRAINT fk_orderdetails_product FOREIGN KEY (product_id) REFERENCES products(id),
    CONSTRAINT fk_orderdetails_order FOREIGN KEY (order_id) REFERENCES orders(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE payments (
    id INT(11) NOT NULL AUTO_INCREMENT,
    order_id INT(11) DEFAULT NULL,
    payment_method VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    payment_date DATE DEFAULT NULL,
    amount DECIMAL(10,2) DEFAULT NULL,
    status VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    PRIMARY KEY (id),
    KEY order_id (order_id),
    CONSTRAINT fk_payments_order FOREIGN KEY (order_id) REFERENCES orders(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE products (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL,
    description TEXT COLLATE utf8mb4_general_ci DEFAULT NULL,
    brand_id INT(11) DEFAULT NULL,
    model VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    price DECIMAL(10,2) DEFAULT NULL,
    stock INT(11) DEFAULT NULL,
    category_id INT(11) DEFAULT NULL,
    image_url VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    PRIMARY KEY (id),
    KEY idx_brand_id (brand_id),
    KEY idx_category_id (category_id),
    CONSTRAINT fk_products_brand FOREIGN KEY (brand_id) REFERENCES brands(id),
    CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE shipments (
    id INT(11) NOT NULL AUTO_INCREMENT,
    order_id INT(11) DEFAULT NULL,
    shipping_company VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    tracking_number VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    shipping_date DATE DEFAULT NULL,
    estimated_delivery_date DATE DEFAULT NULL,
    shipping_status VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    PRIMARY KEY (id),
    KEY order_id (order_id),
    CONSTRAINT fk_shipments_order FOREIGN KEY (order_id) REFERENCES orders(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL,
    last_name VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    email VARCHAR(150) COLLATE utf8mb4_general_ci NOT NULL,
    phone VARCHAR(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
    address TEXT COLLATE utf8mb4_general_ci DEFAULT NULL,
    registration_date DATE DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;