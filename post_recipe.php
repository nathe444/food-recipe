<?php
include('./partials/header.php');
include('./config/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Submit a Recipe</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    .container {
      padding: 40px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      color: #fff;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: black;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      background-color: rgba(122, 120, 120, 0.14);
      color: rgb(100, 93, 93);
    }

    input::placeholder,
    textarea::placeholder {
      color: rgb(178, 188, 178);
    }

    .submit-recipe-btn {
      background: rgb(30, 171, 30);
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
      transition: 0.3s;
    }

    .submit-recipe-btn:hover {
      background: #27812a;
    }
  </style>
</head>

<body>
  <div class="container">
    <form action="post_recipe.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Recipe Title</label>
        <input type="text" id="title" name="title" maxlength="30" placeholder="Enter recipe title" required />
      </div>
      <div class="form-group">
        <label for="ingredients">Ingredients</label>
        <textarea id="ingredients" name="ingredients" rows="3" placeholder="Enter ingredients" required></textarea>
      </div>
      <div class="form-group">
        <label for="instructions">Instructions</label>
        <textarea id="instructions" name="instructions" rows="5" placeholder="Enter instructions" required></textarea>
      </div>
      <div class="form-group">
        <label for="time">Total Time (minutes)</label>
        <input type="number" id="time" name="time" placeholder="Enter total time" min="1" required />
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" required>
          <option value="" disabled selected>Select a category</option>
          <option value="breakfast">Breakfast</option>
          <option value="lunch">Lunch</option>
          <option value="dinner">Dinner</option>
          <option value="dessert">Dessert</option>
          <option value="snack">Snack</option>
          <option value="appetizer">Appetizer</option>
          <option value="beverage">Beverage</option>
          <option value="salad">Salad</option>
          <option value="soup">Soup</option>
          <option value="drink">Drink</option>
          <option value="meat">Meat</option>
          <option value="vegan">Vegan</option>
        </select>
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*" required />
      </div>
      <!-- <div class="form-group">
        <label for="ratings">Ratings</label>
        <input type="number" id="ratings" name="ratings" step="0.1" min="0" max="5" placeholder="Enter ratings (0-5)" required />
      </div> -->
      <button type="submit" name="submit" class="submit-recipe-btn">Submit Recipe</button>
    </form>
  </div>
</body>

</html>
<?php

// $user = $_SESSION['userid'];
// echo $user;



if (isset($_POST['submit'])) {

  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
  $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_SPECIAL_CHARS);
  $instructions = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_SPECIAL_CHARS);
  $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_SPECIAL_CHARS);
  $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);

  // Get username from session
  $user = $_SESSION['userid'];

  // File upload handling
  $image = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $image_folder = './posted_images/'; // Specify the folder where images will be stored
  $image_path = $image_folder . $image;

  if (move_uploaded_file($image_tmp, $image_path)) {
    // File uploaded successfully
  } else {
    // Failed to upload file
    echo "Failed to upload image.";
  }

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare SQL statement with placeholders
  $stmt = mysqli_prepare($conn, "INSERT INTO recipes (title, ingredients, instructions, total_time, category, image_path, user_id) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");

  // Bind parameters to prepared statement
  mysqli_stmt_bind_param($stmt, "sssissi", $title, $ingredients, $instructions, $time, $category, $image_path, $user);

  // Execute statement
  if (mysqli_stmt_execute($stmt)) {
    echo '<script type="text/javascript">alert("Recipe posted successfully")</script>';


    exit();
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  // Close statement and connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>