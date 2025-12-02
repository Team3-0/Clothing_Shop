

<?php

//This should be run to set up the Database and tables for the clothing store.

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ClothingStore";

//Try to create the database
try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //Drops the database if it exists, then creates a new one.
  $sql = "
  DROP DATABASE IF EXISTS ClothingStore;
  CREATE DATABASE ClothingStore;";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Database created successfully<br>";
} catch(PDOException $e) {
  echo $e->getMessage();
}

//Try to create the tables
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to create table
  //Product - table of store products
  //User - table of registered customers
  //Orders - Table of orders made by users.
  //CartItems - a table of items in all user carts. contains the primary keys of the user and what product they are purchasing.
  $sql = 
  "CREATE TABLE Product (
  id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  title VARCHAR(150) NOT NULL,
  price FLOAT NOT NULL,
  descript VARCHAR(150) NOT NULL,
  section VARCHAR(30) NOT NULL,
  category VARCHAR(30) NOT NULL,
  thumbnail VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
  );

  CREATE TABLE User (
  email VARCHAR(50) NOT NULL,
  username VARCHAR(50) NOT NULL,
  pass VARCHAR(50) NOT NULL,
  PRIMARY KEY (email)
  );


  CREATE TABLE `Order` (
  id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  email VARCHAR(50) NOT NULL,
  addr VARCHAR(50) NOT NULL,
  total FLOAT NOT NULL,
  tax FLOAT NULL NULL,
  discount_amount FLOAT NULL NULL,
  shipping_amount FLOAT NULL NULL,
  subtotal FLOAT NULL NULL,
  discount_code VARCHAR(50) NOT NULL,
  shipping_type VARCHAR(20) NOT NULL,
  purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (email) REFERENCES User(email)
  );

  CREATE TABLE OrderItem (
  id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  order_id BIGINT UNSIGNED NOT NULL,
  product_id BIGINT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL,
  price FLOAT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (order_id) REFERENCES `Order`(id)
  );

  
  CREATE TABLE CartItems (
  id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  user_email VARCHAR(50),
  product_id BIGINT UNSIGNED,
  product_size VARCHAR(2),
  quantity INT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  FOREIGN KEY (user_email) REFERENCES User(email),
  FOREIGN KEY (product_id) REFERENCES Product(id)
  );
  
  ";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Tables created successfully";
} catch(PDOException $e) {
  echo $e->getMessage();
}

//Try to insert data
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Cozy sweatshirt', 49.99, 'A comfortable sweatshirt for your fall needs.', 'Men',  'Men', 'Men/cozy sweatshirt.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Long sleeve button-up shirt', 49.99, 'A stylish long-sleeve shirt.', 'Men',  'Men', 'Men/Long Sleeve  button-up shirt.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Oversized t-shirt', 49.99, 'A comfortable t-shirt for your fall needs.', 'Men',  'Men', 'Men/oversized T-shirt.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Pants', 49.99, 'A snazzy pair of pants.', 'Men',  'Men', 'Men/pants.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Shorts', 49.99, 'A comfortable pair of shorts for the summer.', 'Men',  'Men', 'Men/shorts.jpg');

  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('2pcs set - Hoodie and sweatpants', 44.99, 'A full clothing set that will keep you warm.', 'Women',  'Women', 'Women/2pcs set - Hoodie and sweatpants.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Crop top', 44.99, 'A stylish crop top shirt.', 'Women',  'Women', 'Women/oversized crop shirt.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Oversized t-shirt', 44.99, 'A comfortable t-shirt for your fall needs.', 'Women',  'Women', 'Women/oversized T-shirt.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Pleated wide leg pants', 44.99, 'A comfortable sweatshirt for your fall needs.', 'Women',  'Women', 'Women/Pleated wide leg pants.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Zebra patterned viscose shirt and pants set', 44.99, 'A snazzy pair of pants.', 'Women',  'Women', 'Women/zebra.jpg');

  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('2pcs - Shirt and pants set', 29.99, 'A stylish outfit for your child.', 'Kids',  'Kids', 'Kids/2pcs - shirt and pants.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Picnic dress', 29.99, 'Perfect for the summer.', 'Kids',  'Kids', 'Kids/picnic dress.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('2pcs - T-shirt and pants set', 29.99, 'A comfortable and casual t-shirt set.', 'Kids',  'Kids', 'Kids/2pcs - T-shirt and pants.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Hoodie', 29.99, 'A comfortable sweatshirt for your fall needs.', 'Kids',  'Kids', 'Kids/Hoodie.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Striped button-up shirt', 29.99, 'A snazzy shirt for your child.', 'Kids',  'Kids', 'Kids/striped button-up shirt.jpg');

  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Earrings', 19.99, 'Spice up your look with these earrings.', 'Accessories',  'Accessories', 'Accessories/earrings.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Hat', 19.99, 'Perfect for a day at the beach.', 'Accessories',  'Accessories', 'Accessories/hat.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Necklace', 19.99, 'Spice up your look with this necklace.', 'Accessories',  'Accessories', 'Accessories/necklace.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Scarf', 19.99, 'A comfortable scarf for your fall needs.', 'Accessories',  'Accessories', 'Accessories/Scarf.jpg');
  INSERT INTO Product (title, price, descript, section, category, thumbnail)
  VALUES ('Sunglasses', 19.99, 'Perfect for a day at the beach.', 'Accessories',  'Accessories', 'Accessories/Sunglasses.jpg');
  ";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;
?>