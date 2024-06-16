<?php

include('./config/database.php');


// $sql = "USE recipedb";
// if ($conn->query($sql) === TRUE) {
//   echo "Database selected successfully";
// } else {
//   echo "Error selecting database: " . $conn->error;
// }

// $sql = "CREATE TABLE reviews (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   recipe_id INT NOT NULL,
//   user_id INT NOT NULL,
//   review TEXT,
//   FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
//   FOREIGN KEY (user_id) REFERENCES users(user_id)
// )";



// $sql = "CREATE TABLE recipes (
//     recipe_id INT AUTO_INCREMENT PRIMARY KEY,
//     title VARCHAR(255) NOT NULL,
//     ingredients TEXT NOT NULL,
//     instructions TEXT NOT NULL,
//     total_time INT NOT NULL,
//     category VARCHAR(100) NOT NULL,
//     image_path VARCHAR(255) NOT NULL,
//     ratings DECIMAL(3, 1) NOT NULL,
//      user_id INT NOT NULL,
//     FOREIGN KEY (user_id) REFERENCES users(user_id)
// )";

mysqli_query($conn, $sql);
