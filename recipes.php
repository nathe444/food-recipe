<?php
include('./partials/header.php');
include('./config/database.php');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Define a default search query if none provided
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// SQL query to fetch recipes based on search term
$sql = "SELECT * FROM recipes WHERE title LIKE '%$search%' OR category LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipe List</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    .title-and-search {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-top: 25px;
      gap: 30px;
    }

    .title,
    .title span {
      text-align: center;
      font-family: "Great Vibes";
      font-weight: 900;
      font-size: 45px;
    }

    form {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      justify-content: center;
    }

    .search-bar input {
      width: 350px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }

    .search-button {
      background-color: orange;
      border: none;
      padding: 11px;
      border-top-right-radius: 18px;
      border-bottom-right-radius: 18px;
      cursor: pointer;
    }

    .search-button:hover {
      background-color: orangered;
    }

    .search-button svg {
      width: 24px;
      height: 24px;
      fill: #555;
    }

    .container {
      padding: 15px 40px;
      color: #000;
    }

    .recipe-card {
      width: 400px;
      background-color: #e0f7fa;
      border-radius: 20px;
      box-shadow: 1px 1px 12px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      transition: transform 0.33s;
      margin-bottom: 20px;
      text-align: center;
    }

    @media(max-width:500px) {
      .recipe-card {
        width: 350px;
      }

      .search-bar input {
        width: 300px;
      }
    }

    .recipe-card:hover {
      cursor: pointer;
      transform: scale(1.1);
    }

    .recipe-image img {
      width: 80%;
      height: 250px;
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
    }

    .recipe-content {
      padding: 10px;
    }

    .recipe-title {
      font-size: 24px;
      font-weight: 700;
      margin: 10px 0px 20px 0px;
      text-align: center;
    }

    .recipe-info {
      display: flex;
      justify-content: space-around;
      padding: 0px 10px;
      margin-bottom: 20px;
    }

    .recipe-info img {
      width: 25px;
      margin-right: 4px;
    }

    .recipe-info>div {
      display: flex;
      align-items: center;
    }

    .recipe-info i {
      margin-right: 5px;
    }

    .recipe-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px 60px;
      justify-content: center;
    }

    .recipe-link {
      text-decoration: none;
      color: #000;
      transition: 0.33s;
    }

    .recipe-link:hover {
      .recipe-title {
        text-decoration: underline;
        color: #555;
      }
    }
  </style>
</head>

<body>
  <div class="title-and-search">
    <h1 class=" title"> <span style="color:orange;">Recipe</span> List</h1>

    <div class="search-bar">
      <form id="recipeSearchForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="text" id="searchInput" name="search" placeholder="Search for recipes...">

        <button type="submit" class="search-button">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
          </svg>
        </button>
      </form>
    </div>

  </div>


  <div class="container">

    <div class="recipe-list" data-aos="fade-up" data-aos-duration="1500">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // Generate link to recipe detail page
          $recipeId = $row['recipe_id']; // Assuming your recipe table has an 'id' column
          $recipeLink = 'recipe_detail.php?id=' . $recipeId;

          echo "<a href='$recipeLink' class='recipe-link'>";
          echo "<div class='recipe-card'>";
          echo "<div class='recipe-image'><img src='" . htmlspecialchars($row['image_path']) . "' alt='Recipe Image'></div>";
          echo "<div class='recipe-content'>";
          echo "<h1 class='recipe-title'>" . htmlspecialchars($row['title']) . "</h1>";
          echo "<div class='recipe-info'>";
          echo "<div><img src='./images/clock.png' alt=''><span>" . htmlspecialchars($row['total_time']) . " min</span></div>";
          echo "<div><img src='./images/knife-fork.png' alt=''><span>" . htmlspecialchars($row['category']) . "</span></div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</a>";
        }
      } else {
        echo "<p>No recipes found</p>";
      }

      mysqli_close($conn);
      ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js">
  </script>
  <script>
    AOS.init();
  </script>
</body>

</html>