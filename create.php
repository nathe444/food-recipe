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

// $sql = "INSERT INTO recipes (title, ingredients, instructions, total_time, category, image_path, user_id) VALUES 
// ('Chocolate Chip Cookies', '1 cup butter, softened\n1 cup white sugar\n1 cup packed brown sugar\n2 eggs\n2 teaspoons vanilla extract\n3 cups all-purpose flour\n1 teaspoon baking soda\n2 teaspoons hot water\n1/2 teaspoon salt\n2 cups semisweet chocolate chips', '1. Preheat oven to 350 degrees F (175 degrees C).\n2. Cream together the butter, white sugar, and brown sugar until smooth.\n3. Beat in the eggs one at a time, then stir in the vanilla.\n4. Dissolve baking soda in hot water. Add to batter along with salt.\n5. Stir in flour, chocolate chips, and nuts.\n6. Drop by large spoonfuls onto ungreased pans.\n7. Bake for about 10 minutes in the preheated oven, or until edges are nicely browned.', 30, 'Snack', './images/choco-2.jpg',18),
// ('Pasta', '1 pound pasta\n2 tablespoons olive oil\n1 clove garlic, minced\n1 can (28 ounces) crushed tomatoes\n1 teaspoon salt\n1/4 teaspoon black pepper\n1/2 teaspoon dried oregano\n1/4 cup fresh basil, chopped\n1/4 cup grated Parmesan cheese', '1. Cook pasta according to package instructions.\n2. Heat olive oil in a large pan over medium heat.\n3. Add garlic and sauté until fragrant.\n4. Stir in crushed tomatoes, salt, pepper, and oregano. Simmer for 15 minutes.\n5. Mix in cooked pasta and basil.\n6. Serve topped with grated Parmesan cheese.', 35, 'Lunch', './images/pasta.jpg',18),
// ('Salad', '4 cups mixed greens\n1 cup cherry tomatoes, halved\n1/2 cucumber, sliced\n1/4 red onion, thinly sliced\n1 avocado, diced\n1/4 cup olive oil\n2 tablespoons balsamic vinegar\nSalt and pepper to taste', '1. In a large bowl, combine mixed greens, cherry tomatoes, cucumber, red onion, and avocado.\n2. In a small bowl, whisk together olive oil, balsamic vinegar, salt, and pepper.\n3. Drizzle dressing over salad and toss to coat.', 20, 'Vegan', './images/salad.jpg',18),
// ('Smoothie', '1 banana\n1/2 cup frozen berries\n1/2 cup yogurt\n1/2 cup orange juice\n1 tablespoon honey', '1. Combine all ingredients in a blender.\n2. Blend until smooth.\n3. Serve immediately.', 25, 'Dessert', './images/smoothie.avif',18),
// ('Pancake', '1 cup all-purpose flour\n2 tablespoons sugar\n2 teaspoons baking powder\n1/2 teaspoon salt\n1 cup milk\n1 egg\n2 tablespoons melted butter', '1. In a bowl, mix flour, sugar, baking powder, and salt.\n2. In another bowl, whisk milk, egg, and melted butter.\n3. Combine the wet and dry ingredients.\n4. Heat a lightly oiled griddle over medium-high heat.\n5. Pour batter onto the griddle and cook until bubbles form. Flip and cook until browned.', 30, 'Breakfast', './images/pancake.jpg',18),
// ('Cocktail', '1 1/2 oz vodka\n1 oz cranberry juice\n1/2 oz triple sec\n1/2 oz fresh lime juice\nIce', '1. Fill a shaker with ice.\n2. Add vodka, cranberry juice, triple sec, and lime juice.\n3. Shake well and strain into a chilled glass.', 20, 'Beverage', './images/cocktail.jpg',18)";

// if ($conn->query($sql) === TRUE) {
//   echo "recipes inserted successfully <br>";
// } else {
//   echo "Error inserting records: " . $conn->error;
// }



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
