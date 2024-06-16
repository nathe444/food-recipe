<?php
include('./partials/header.php');
include('./config/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Food recipe</title>

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
      /* position: absolute;
        top: 20%;
        left: 15%; */
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
      padding: 0px 50px;
      margin-bottom: 50px;
    }

    .landing-recipes>h1,
    .landing-recipes>p {
      text-align: center;
      max-width: 820px;
      margin: auto;
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
      row-gap: 50px;
    }

    .recipe-card {
      width: 400px;
      background-color: #e0f7fa;

      border-radius: 20px;
      box-shadow: 1px 1px 12px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      transition: 0.33s;
    }

    .recipe-card:hover {
      cursor: pointer;
      scale: 1.1;
    }

    .recipe-image img {
      width: 100%;
      height: 270px;
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
      padding: 0px 100px;
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



    /* .about-image img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
      } */
  </style>
</head>


<body>

  <div class="landing">
    <div class="landing-left">
      <h1 class="burger-h1">
        Make Your Own Fresh <br /><span class="food">Food</span>in a Easy Way
      </h1>
      <p>
        Make Your Own Fresh Food in an Easy Way! Discover the joy of cooking fresh, wholesome meals in the comfort of your own kitchen. Whether you're an experienced chef or just starting out, our recipes are designed to be easy to follow, ensuring you can create delicious dishes with ease. Embrace the art of cooking and bring a burst of flavor to your meals with fresh ingredients and simple techniques.Let's make cooking fun, easy, and most importantly, fresh!
    </div>

    <div class="landing-right">
      <img src="./images/burger.png" alt="" />
    </div>
  </div>

  <div class="categories">
    <h1>Categories</h1>

    <div class="categories-container">
      <div class="category-card">
        <a href="recipes.php?search=breakfast">Breakfast</a>
      </div>
      <div class="category-card">
        <a href="recipes.php?search=lunch">Lunch</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=dinner">Dinner</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=dessert">Dessert</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=snack">Snack</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=appetizer">Appetizer</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=beverage">Beverage</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=soup">Soup</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=drink">Drink</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=meat">Meat</a>
      </div>

      <div class="category-card">
        <a href="recipes.php?search=vegan">Vegan</a>
      </div>
    </div>
  </div>

  <div class="landing-recipes">
    <h1>Simple And Tasty Recipes</h1>
    <p>
      Discover a collection of easy-to-make and delicious recipes that will delight your taste buds. Our recipes are crafted to be simple yet flavorful, perfect for both beginners and experienced cooks. Whether you're looking for a quick meal after a busy day or a sumptuous dish to impress your guests, we've got you covered.
    </p>

    <div class="landing-recipes-container">
      <div class="recipe-card">
        <div class="recipe-image">
          <img src="./images/choco.jpg" alt="" />
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
              <span>Catagory</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card">
        <div class="recipe-image">
          <img src="./images/choco.jpg" alt="" />
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
              <span>Catagory</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card">
        <div class="recipe-image">
          <img src="./images/choco.jpg" alt="" />
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
              <span>Catagory</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card">
        <div class="recipe-image">
          <img src="./images/choco.jpg" alt="" />
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
              <span>Catagory</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card">
        <div class="recipe-image">
          <img src="./images/choco.jpg" alt="" />
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
              <span>Catagory</span>
            </div>
          </div>
        </div>
      </div>

      <div class="recipe-card">
        <div class="recipe-image">
          <img src="./images/choco.jpg" alt="" />
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
              <span>Catagory</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="landing">
    <div class="landing-right">
      <img src="./images/chef.png" alt="" />
    </div>
    <div class="landing-left">
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
    <div class="about-content">
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
</body>

</html>