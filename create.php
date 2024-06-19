<?php
$SERVER = "localhost";
$USER = "root";
$PASS = "";

$conn = mysqli_connect($SERVER, $USER, $PASS);
$sql = "CREATE DATABASE IF NOT EXISTS recipedb";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully <br>";
} else {
  echo "Error creating database: " . $conn->error;
}

$sql = "USE recipedb";
if ($conn->query($sql) === TRUE) {
  echo "Database selected successfully <br>";
} else {
  echo "Error selecting database: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS users (
  user_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstname varchar(30) NOT NULL,
  lastname varchar(30) NOT NULL,
  username varchar(30) NOT NULL UNIQUE,
  email varchar(30) NOT NULL UNIQUE,
  password varchar(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "users table created successfully <br>";
} else {
  echo "Error creating database: " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS recipes (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    total_time INT NOT NULL,
    category VARCHAR(100) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
     user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)";
if ($conn->query($sql) === TRUE) {
  echo "recipes table created successfully <br>";
} else {
  echo "Error creating database: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  recipe_id INT NOT NULL,
  user_id INT NOT NULL,
  review TEXT,
  FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
)";


if ($conn->query($sql) === TRUE) {
  echo "reviews table created successfully <br>";
} else {
  echo "Error creating database: " . $conn->error;
}
