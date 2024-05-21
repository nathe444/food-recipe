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
    }

    .great-vibes-regular {
      font-family: "Great Vibes", cursive;
      font-weight: 400;
      font-style: normal;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      padding: 10px 0px;
      align-items: center;
      gap: 30px;
      position: sticky;
      top: 0;
      left: 0;
      padding: 20px 50px;
      box-shadow: 0px 3px 8px rgba(210, 211, 210, 0.9);
      background-color: white;
      z-index: 2;
    }

    .nav-left {
      flex: 1;
      /* background-color: red; */
    }

    .nav-left h1 {
      font-family: "Great Vibes";
      font-size: 38px;
    }

    .nav-center {
      flex: 2;
      /* background-color: blue; */
    }

    .nav-center ul {
      display: flex;
      justify-content: space-around;
      list-style: none;
    }

    .nav-center ul li a {
      text-decoration: none;
      color: black;
      font-weight: bold;
      font-size: 18px;
      position: relative;
      padding: 5px 0;
    }

    .nav-center ul li a::before {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background-color: grey;
      transition: width 0.5s ease;
    }

    .nav-center ul li a:hover::before {
      width: 100%;
    }

    .nav-right {
      flex: 1;
      /* background-color: bisque; */
    }

    .nav-right ul {
      display: flex;
      justify-content: space-around;
      padding: 0px 0px 0px 70px;
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
      width: 800px;
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
      background-color: #f9f8e9;
      border-radius: 20px;
      box-shadow: 1px 1px 12px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      transition: 0.33s;
    }

    .recipe-card:hover {
      cursor: pointer;
      scale: 1.13;
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
      background-color: rgb(239, 234, 228);
      box-shadow: 2px 2px 2px rgba(1, 1, 1, 0.5);
      border-radius: 20px;
      color: rgb(89, 85, 85);
      font-weight: bold;
      transition: 0.4s ease-out;
    }

    .category-card:hover {
      cursor: pointer;
      background-color: rgb(89, 85, 85);
      color: rgb(239, 234, 228);
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
  <div class="navbar">
    <div class="nav-left">
      <h1>Food Recipe</h1>
    </div>

    <div class="nav-center">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="recipes.php">Recipes</a></li>
        <li><a href="add.php">Post Recipe</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>

    <div class="nav-right">
      <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
    </div>
  </div>

  <div class="landing">
    <div class="landing-left">
      <h1 class="burger-h1">
        Make Your Own Fresh <br /><span class="food">Food</span>in a Easy Way
      </h1>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur
        ullam cumque maiores laborum, eaque tenetur sint quas error, et
        repudiandae laboriosam ea, vitae molestiae illo blanditiis doloribus
        magni maxime. Fuga! Lorem ipsum dolor sit amet consectetur adipisicing
        elit. Dolorem asperiores cumque ratione iure esse sed, voluptatibus
        quia ipsum nihil, voluptate explicabo magnam illo nemo animi libero
        vero obcaecati? Illum, dolorem.
      </p>
    </div>

    <div class="landing-right">
      <img src="./images/burger.png" alt="" />
    </div>
  </div>

  <div class="categories">
    <h1>Categories</h1>

    <div class="categories-container">
      <div class="category-card">
        <p>Breakfast</p>
      </div>
      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>

      <div class="category-card">
        <p>Breakfast</p>
      </div>
    </div>
  </div>

  <div class="landing-recipes">
    <h1>Simple And Tasty Recipes</h1>
    <p>
      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga sint
      provident minima quidem, ullam vitae hic necessitatibus dolore vero
      ipsam nulla fugiat cumque minus consectetur odit alias officiis maxime
      esse.
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
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla
        adipisci quis eos asperiores dolore. Unde modi veritatis corrupti
        adipisci hic labore in atque fugiat non, id, molestiae maiores, quae
        ducimus? Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        Praesentium dolorem assumenda eos odio molestiae voluptatibus
        blanditiis repellendus vitae sapiente dolorum, totam delectus
        distinctio exercitationem sequi id, quia nostrum alias. Placeat!
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