<?php
include('./partials/header.php');
include('./config/database.php');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM recipes where username = 'nati'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Food recipe</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">


  <style>
    @import url("https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .great-vibes-regular {
      font-family: "Great Vibes", cursive;
      font-weight: 400;
      font-style: normal;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .landing {
      display: flex;
      padding: 0px 50px;
    }

    .landing-left {
      width: 50%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      gap: 50px;
      color: rgb(111, 109, 109);
    }

    .landing-left h1 {
      font-size: 55px;
      color: black;
    }

    .landing-left p {
      line-height: 1.3;
    }

    .food {
      color: orange;
      margin: 0px 12px 0px 0px;
    }

    .landing-right {
      width: 50%;
      color: rgb(111, 109, 109);
    }

    .landing-right img {
      width: 100%;
      height: 650px;
    }

    .burger-h1 {
      line-height: 1.25;
    }

    .chef-h1 {
      line-height: 1.2;
    }

    .landing-recipes {
      padding: 0px 0px;

    }

    .landing-recipes>h1,
    .landing-recipes>p {
      text-align: center;
      max-width: 820px;
      margin: auto;
      padding: 0px 50px;
    }

    .landing-recipes>h1 {
      font-size: 45px;
      margin-top: 100px;
    }

    .landing-recipes>p {
      font-size: 17px;
      margin-top: 15px;
      color: rgb(111, 109, 109);
      margin-bottom: 50px;

    }

    .landing-recipes-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      place-items: center;
      row-gap: 60px;
      padding: 0px 50px;
    }

    .recipe-card {
      width: 400px;
      background-color: #e0f7fa;
      border-radius: 20px;
      box-shadow: 1px 1px 12px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .recipe-card:hover {
      cursor: pointer;
      transition: ease 0.2s;
      scale: 1.1;
    }



    .recipe-image img {
      width: 100%;
      height: 270px;
      object-fit: fill;
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
      object-fit: cover;
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

    .categories {
      margin-top: 50px;
      padding: 0px 50px;
      display: flex;
      flex-direction: column;
      margin-bottom: 15px;
    }

    .categories h1 {
      font-size: 50px;
      text-align: center;
      margin-bottom: 30px;
    }

    .categories-container {
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .categories-container a {
      text-decoration: none;
      color: black;
    }

    .category-card {
      padding: 20px;
      background-color: orange;
      box-shadow: 2px 2px 2px rgba(1, 1, 1, 0.5);
      border-radius: 20px;
      color: rgb(89, 85, 85);
      font-weight: bold;
      transition: 0.3s ease-out;
    }

    .category-card a {
      text-decoration: none;
      color: black;
    }


    .category-card:hover {
      cursor: pointer;
      background-color: orangered;
      color: rgb(239, 234, 228);
    }

    .category-card:hover {
      a {
        text-decoration: underline;
      }

    }

    .about-us {
      position: relative;
      align-items: center;
      background-image: url("images/dishes.png");
      background-repeat: no-repeat;
      background-size: cover;
      height: 550px;
      margin-top: 100px;
      width: 100%;
    }

    .about-content {
      position: absolute;
      top: 0;
      left: 25%;
      width: 50%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
    }

    .about-content .last {
      position: absolute;
      bottom: 5%;
    }

    .about-us::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(21, 20, 2, 0.7);
      backdrop-filter: blur(0.7px);
    }

    .about-title {
      font-size: 40px;
      font-weight: 700;
      margin-bottom: 20px;
      color: rgb(236, 135, 101);
    }

    .about-description {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 20px;
      color: rgb(252, 250, 250);
    }

    .about-image {
      flex: 1;
      text-align: right;
    }

    .recipe-link {
      text-decoration: none;
      color: black;

    }

    .recipe-link:hover {
      .recipe-title {
        text-decoration: underline;
      }
    }

    /* .about-image img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
      } */

    @media(max-width:950px) {

      .landing {
        flex-direction: column-reverse;
        align-items: center;
        padding: 0px 50px;
      }

      .landing-2 {
        flex-direction: column;
        padding: 0px;
        padding: 0px 50px;
        margin-top: 60px;
      }

      .landing-left,
      .landing-right {
        width: 100%;
        justify-content: center;
        align-items: center;
        gap: 35px;
        text-align: center;
      }

      .landing-right img {
        width: 80%;
        max-height: 270px;
        margin: 0 auto;
      }

      @media(580px<width<940px) {
        .landing-right img {
          width: 60%;
          max-height: 350px;
          margin: 0 auto;
        }
      }


      .landing-left p {
        margin: 0px;
      }

      .landing-left h1,
      .categories h1,
      .landing-recipes>h1 {
        font-size: 42px;
        text-align: center;

      }

      .categories h1 {
        margin: 10px 0px 50px 0px;
      }

      .landing-recipes>h1 {
        margin: 70px 0px 40px 0px;
      }

      .landing-recipes-container {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        justify-content: center;
        column-gap: 20px;
      }

      .recipe-card {
        width: 300px;
      }

    }


    @media(max-width:1100px) {
      .about-us {
        height: 820px;
        padding: 0px 0px;
      }

      .about-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;

      }
    }
  </style>
</head>


<body>

  <div class="landing">
    <div class="landing-left" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="">
      <h1 class="burger-h1">
        Make Your Own Fresh <br /><span class="food">Food</span>in a Easy Way
      </h1>
      <p>
        Make Your Own Fresh Food in an Easy Way! Discover the joy of cooking fresh, wholesome meals in the comfort of your own kitchen. Whether you're an experienced chef or just starting out, our recipes are designed to be easy to follow, ensuring you can create delicious dishes with ease. Embrace the art of cooking and bring a burst of flavor to your meals with fresh ingredients and simple techniques.Let's make cooking fun, easy, and most importantly, fresh!
    </div>

    <div class="landing-right" data-aos="flip-left" data-aos-duration="1500">
      <img src="./images/burger.png" alt="" />
    </div>
  </div>

  <div class="categories">
    <h1 data-aos="fade-up" data-aos-duration="1500">Categories</h1>

    <div class="categories-container" data-aos="fade-right" data-aos-duration="1500">

      <a class="category-card" href="recipes.php?search=breakfast">Breakfast</a>

      <a class="category-card" href="recipes.php?search=lunch">Lunch</a>

      <a class="category-card" href="recipes.php?search=dinner">Dinner</a>

      <a class="category-card" href="recipes.php?search=dessert">Dessert</a>

      <a class="category-card" href="recipes.php?search=snack">Snack</a>

      <a class="category-card" href="recipes.php?search=appetizer">Appetizer</a>

      <a class="category-card" href="recipes.php?search=beverage">Beverage</a>

      <a class="category-card" href="recipes.php?search=soup">Soup</a>

      <a class="category-card" href="recipes.php?search=drink">Drink</a>

      <a class="category-card" href="recipes.php?search=meat">Meat</a>

      <a class="category-card" href="recipes.php?search=vegan">Vegan</a>

    </div>
  </div>

  <div class="landing-recipes" data-aos="fade-up" data-aos-duration="1500">

    <h1>Simple And Tasty Recipes</h1>
    <p>
      Discover a collection of easy-to-make and delicious recipes that will delight your taste buds. Our recipes are crafted to be simple yet flavorful, perfect for both beginners and experienced cooks. Whether you're looking for a quick meal after a busy day or a sumptuous dish to impress your guests, we've got you covered.
    </p>

    <div class="landing-recipes-container">

      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $recipeId = $row['recipe_id'];
          $recipeLink = 'recipe_detail.php?id=' . $recipeId;

          echo "<a href='$recipeLink' class='recipe-link'>";
          echo "<div class='recipe-card' data-aos='zoom-in' data-aos-duration='1500'>";
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

      <!-- <div class="recipe-card" data-aos="zoom-in" data-aos-duration="1500">
        <div class="recipe-image">
          <img src="./images/choco-2.jpg" alt="" />
        </div>
        <div class="recipe-content">
          <h1 class="recipe-title">Chocolate Chip Cookies</h1>
          <div class="recipe-info">
            <div>
              <img src="./images/clock.png" alt="" />
              <span>30 min</span>
            </div>
            <div>
              <img src="./images/knife-fork.png" alt="" />
              <span>Snack</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card" data-aos="zoom-out" data-aos-duration="1500">
        <div class="recipe-image">
          <img src="./images/pasta.jpg" alt="" />
        </div>
        <div class="recipe-content">
          <h1 class="recipe-title">Pasta</h1>
          <div class="recipe-info">
            <div>
              <img src="./images/clock.png" alt="" />
              <span>35 min</span>
            </div>
            <div>
              <img src="./images/knife-fork.png" alt="" />
              <span>Lunch</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card" data-aos="zoom-in" data-aos-duration="1500">
        <div class="recipe-image">
          <img src="./images/salad.jpg" alt="" />
        </div>
        <div class="recipe-content">
          <h1 class="recipe-title">Salad</h1>
          <div class="recipe-info">
            <div>
              <img src="./images/clock.png" alt="" />
              <span>20 min</span>
            </div>
            <div>
              <img src="./images/knife-fork.png" alt="" />
              <span>Vegan</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card" data-aos="zoom-out" data-aos-duration="1500">
        <div class="recipe-image">
          <img src="./images/smoothie.avif" alt="" />
        </div>
        <div class="recipe-content">
          <h1 class="recipe-title">Smoothie</h1>
          <div class="recipe-info">
            <div>
              <img src="./images/clock.png" alt="" />
              <span>25 min</span>
            </div>
            <div>
              <img src="./images/knife-fork.png" alt="" />
              <span>Dessert</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card" data-aos="zoom-in" data-aos-duration="1500">
        <div class="recipe-image">
          <img src="./images/pancake.jpg" alt="" />
        </div>
        <div class="recipe-content">
          <h1 class="recipe-title">Pancake</h1>
          <div class="recipe-info">
            <div>
              <img src="./images/clock.png" alt="" />
              <span>30 min</span>
            </div>
            <div>
              <img src="./images/knife-fork.png" alt="" />
              <span>Breakfast</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card" data-aos="zoom-out" data-aos-duration="1500">
        <div class="recipe-image">
          <img src="./images/cocktail.jpg" alt="" />
        </div>
        <div class="recipe-content">
          <h1 class="recipe-title">Cocktail</h1>
          <div class="recipe-info">
            <div>
              <img src="./images/clock.png" alt="" />
              <span>20 min</span>
            </div>
            <div>
              <img src="./images/knife-fork.png" alt="" />
              <span>Beverage</span>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    </div>
    <div class="landing landing-2">
      <div class="landing-right" data-aos="flip-right" data-aos-duration="1500">
        <img src="./images/chef.png" alt="" />
      </div>
      <div class="landing-left" data-aos="fade-down" data-aos-duration="1500">
        <h1 class="chef-h1">
          Everyone Can Be A <br />Chef In Their Own <br />
          Kitchen
        </h1>
        <p>
          Unlock the joy of cooking with our easy-to-follow recipes and become the chef you've always wanted to be. Whether you're a novice or a seasoned home cook, our recipes are designed to inspire and delight. Create delicious dishes from the comfort of your kitchen and experience the satisfaction of homemade meals. Enjoy the process of cooking with fresh, wholesome ingredients and see how simple it can be to make restaurant-quality dishes at home. With our guidance, everyone can be a chef in their own kitchen and turn every meal into a culinary masterpiece.
        </p>
      </div>
    </div>
    <section class="about-us">
      <div class="about-content" data-aos="fade-up" data-aos-duration="1500">
        <h2 class="about-title">About Our Recipe Website</h2>
        <p class="about-description">
          Welcome to our recipe website! We are a team of passionate home cooks
          and food enthusiasts who have come together to share our love for
          delicious and nourishing meals. Our mission is to provide you with a
          vast collection of recipes that cater to a wide range of dietary
          preferences and cooking levels.
        </p>
        <p class="about-description">
          At the heart of our website is a desire to inspire and empower you in
          the kitchen. Whether you're a seasoned chef or a beginner cook, you'll
          find a wealth of recipes, tips, and resources to help you create
          mouthwatering dishes that your family and friends will love.
        </p>
        <p class="about-description">
          Join us on this culinary journey as we explore new flavors, discover
          innovative techniques, and share our passion for food with you. We're
          excited to see what you create in the kitchen and can't wait to hear
          your feedback and recipe suggestions.
        </p>
        <p class="last">&copy; 2024 NatheWorks. All Rights Reserved.</p>
      </div>
      <!-- <div class="about-image">
        <img src="./images/dishes.png" alt="About Us Image" />
      </div> -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>

</html>