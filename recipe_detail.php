<?php
include('./partials/header.php');
include('./config/database.php');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
  $recipeId = mysqli_real_escape_string($conn, $_GET['id']);

  // SQL query to fetch the details of the recipe
  $sql = "SELECT * FROM recipes WHERE recipe_id = '$recipeId'";
  $result = mysqli_query($conn, $sql);

  // Check if the recipe exists
  if (mysqli_num_rows($result) > 0) {
    $recipe = mysqli_fetch_assoc($result);
  } else {
    echo "Recipe not found.";
    exit();
  }
} else {
  echo "No recipe ID provided.";
  exit();
}

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userid'])) {
  $review = mysqli_real_escape_string($conn, $_POST['review']);
  $userId = $_SESSION['userid'];

  $insertReviewSql = "INSERT INTO reviews (recipe_id, user_id, review) VALUES ('$recipeId', '$userId', '$review')";
  mysqli_query($conn, $insertReviewSql);
}

// Fetch reviews
$reviewsSql = "SELECT reviews.review, users.username FROM reviews JOIN users ON reviews.user_id = users.user_id WHERE reviews.recipe_id = '$recipeId'";
$reviewsResult = mysqli_query($conn, $reviewsSql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($recipe['title']); ?> - Recipe Details</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f7f7f7;
      /* color: #333; */
      margin: 0;
      padding: 0;

    }

    .container {
      margin: 0 auto;
      padding: 40px;
    }

    .container-up {
      display: flex;
      gap: 80px;
      justify-content: space-between;

    }

    .recipe-header-info {
      display: flex;
      flex-direction: column;
      gap: 0px;
    }

    .recipe-header {
      background: linear-gradient(45deg, #ff6b6b, #ffcc33);
      color: white;
      padding: 30px;
      text-align: center;
      border-top-right-radius: 10px;
      border-top-left-radius: 10px;
    }

    .recipe-header h1 {
      font-size: 48px;
      margin: 0;
    }

    .recipe-header img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-top: 20px;
      max-height: 500px;
    }

    .recipe-info {
      display: flex;
      justify-content: space-between;
      background: #fff;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-bottom-right-radius: 10px;
      border-bottom-left-radius: 10px;
      gap: 30px;
    }

    .recipe-info div {
      display: flex;
      align-items: center;
    }

    .recipe-info img {
      width: 30px;
      margin-right: 10px;
    }


    .instruction-and-ingredients {
      display: flex;
      flex-direction: column;
      justify-content: center;
      width: 99%;
    }

    .recipe-section {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      max-width: 820px;
      overflow-x: auto;
      overflow-wrap: break-word;
      word-wrap: break-word;
    }

    @media screen and (max-width: 950px) {
      .container-up {
        flex-direction: column;
      }
    }

    @media screen and (950px<width<1300px) {
      .recipe-section {
        max-width: 510px;
      }
    }

    .recipe-section h2 {
      font-size: 32px;
      margin-bottom: 10px;
      color: orange;
      text-decoration: underline;
    }

    .recipe-section p {
      white-space: pre-wrap;
      font-size: 18px;
      line-height: 1.3;
    }

    .reviews-section {
      margin-top: 40px;
    }

    .review-form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 40px;
    }

    .review-form form {
      display: flex;
      flex-direction: column;
    }

    .review-form textarea {
      resize: vertical;
      padding: 10px;
      font-size: 16px;
      border-radius: 10px;
      border: 1px solid #ddd;
      margin-bottom: 10px;
    }

    .review-form button {
      background: #ff6b6b;
      color: white;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .review-form button:hover {
      background: #ff4757;
    }

    .review {
      background: #fff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 15px;
    }

    .review .username {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #ff6b6b;
      font-weight: 700;
    }

    .back-link:hover {
      color: #ff4757;
    }

    .reviews-list h1 {
      margin: 60px 0px 10px 0px;
    }
  </style>
</head>

<body>
  <div class="container">

    <div class="container-up">
      <div class="recipe-header-info" data-aos="zoom-in-down" data-aos-duration="1500">
        <div class="recipe-header">
          <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
          <div class="recipe-image">
            <img src="<?php echo htmlspecialchars($recipe['image_path']); ?>" alt="Recipe Image">
          </div>
        </div>

        <div class="recipe-info">
          <div>
            <img src="./images/clock.png" alt="Total Time">
            <span><?php echo htmlspecialchars($recipe['total_time']); ?> min</span>
          </div>
          <div>
            <img src="./images/knife-fork.png" alt="Category">
            <span><?php echo htmlspecialchars($recipe['category']); ?></span>
          </div>
        </div>
      </div>



      <div class="instruction-and-ingredients" data-aos="zoom-in-up" data-aos-duration="1500">
        <div class="recipe-section">
          <h2>Ingredients</h2>
          <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
        </div>

        <div class="recipe-section">
          <h2>Instructions</h2>
          <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
        </div>

      </div>
    </div>

    <div class="reviews-list" data-aos="fade-up" data-aos-duration="1500">
      <h1>Review list</h1>
      <?php if (mysqli_num_rows($reviewsResult) > 0) : ?>
        <?php while ($review = mysqli_fetch_assoc($reviewsResult)) : ?>

          <div class="review">

            <div class="username"><?php echo htmlspecialchars($review['username']); ?></div>
            <p><?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
          </div>
        <?php endwhile; ?>
      <?php else : ?>
        <p>No reviews yet.</p>
      <?php endif; ?>
    </div>




    <div class="reviews-section" data-aos="fade-up" data-aos-duration="1500">
      <h2>Reviews</h2>

      <?php if (isset($_SESSION['userid'])) : ?>
        <div class="review-form">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$recipeId"; ?>" method="POST">
            <textarea name="review" id="review" rows="6" required></textarea>
            <button type="submit">Submit Review</button>
          </form>
        </div>
      <?php else : ?>
        <p><a href="login.php">Log in</a> to submit a review.</p>
      <?php endif; ?>


    </div>

    <a href="recipes.php" class="back-link">Back to Recipe List</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js">
  </script>
  <script>
    AOS.init();
  </script>
</body>

</html>