CREATE DATABASE IF NOT EXISTS friend_webbshop;
USE friend_webbshop;

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    street_adress VARCHAR(255) NOT NULL,
    postcode VARCHAR(10) NOT NULL,
    city VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS under_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    under_category_id INT,
    popularity INT NOT NULL DEFAULT 0,
    FOREIGN KEY (under_category_id) REFERENCES under_categories(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS shopping_carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT,
    product_id INT,
    quantity INT NOT NULL DEFAULT 1,
    FOREIGN KEY (cart_id) REFERENCES shopping_carts(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

DELIMITER //

CREATE TRIGGER update_cart_timestamp_after_insert
AFTER INSERT ON cart_items
FOR EACH ROW
BEGIN
    UPDATE shopping_carts
    SET updated_at = NOW()
    WHERE id = NEW.cart_id;
END;
//

CREATE TRIGGER update_cart_timestamp_after_update
AFTER UPDATE ON cart_items
FOR EACH ROW
BEGIN
    UPDATE shopping_carts
    SET updated_at = NOW()
    WHERE id = NEW.cart_id;
END;
//

DELIMITER ;