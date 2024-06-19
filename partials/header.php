<?php
session_start();
include('./config/database.php');
$user = isset($_SESSION['username']);

if (isset($_POST['logout-submit'])) {
  try {
    if (isset($user)) {
      session_unset();
      session_destroy();
      header("Location:index.php");
      exit();
    }
  } catch (Exception $e) {
    echo '<script type="text/javascript">alert("' . $e->getMessage() . '");</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins';
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
      align-items: center;
      gap: 30px;
      padding: 20px 50px;
      box-shadow: 0px 3px 8px rgba(210, 211, 210, 0.9);
      background-color: white;
      z-index: 2;
    }

    .nav-left {
      flex: 1;
    }

    .nav-left h1,
    .nav-left span {
      font-family: "Great Vibes";
      font-size: 36px;
      width: 200px;
    }

    .nav-center {
      flex: 2;
    }

    .nav-center ul,
    .nav-right ul {
      display: flex;
      justify-content: space-around;
      list-style: none;
    }

    .nav-center ul li a,
    .nav-right ul li a {
      text-decoration: none;
      color: black;
      font-weight: bold;
      font-size: 18px;
      position: relative;
      padding: 5px 0;
    }

    .nav-right button {
      display: inline-block;
      font-weight: 600;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      border: none;
      padding: 0.75rem 1.5rem;
      font-size: 0.9rem;
      line-height: 1.5;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
      width: 100px;
    }

    .register-btn {
      background-color: #edf2f7;
      color: #342f57;
    }

    .register-btn:hover {
      background-color: #e2e8f0;
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .login-btn {
      background-color: #402f57;
      color: #fff;
    }

    .login-btn:hover {
      background-color: #4a5568;
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .logout-btn {
      background-color: #dc3545;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 8px 16px;
      font-size: 14px;
      font-weight: bold;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #c82333;
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
    }

    .nav-right ul {
      display: flex;
      justify-content: end;
      gap: 10px;
    }

    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
    }

    .hamburger div {
      width: 25px;
      height: 4px;
      margin: 3px;
      background-color: black;
      transition: all 0.3s ease;
    }

    .nav-menu {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      padding-left: 6vw;
      gap: 45px;
      transition: max-height 0.7s;
      overflow: hidden;
    }

    @media(max-width:950px) {
      .navbar {
        align-items: center;
        padding: 15px 40px;
        align-items: baseline;
        flex-direction: column;
      }

      .hamburger {
        display: flex;
        position: absolute;
        right: 30;
        top: 16;
        z-index: 10px;
      }

      .nav-menu {
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-height: 0;
      }

      .nav-menu.active {
        position: relative;
        max-height: 500px;
        align-items: center;
      }

      .nav-center ul,
      .nav-right ul {
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }

      .nav-right {
        margin-top: -20px;
      }
    }
  </style>
</head>

<body>
  <div class="navbar">
    <div class="nav-left">
      <h1>Food <span style="color:orange;">Recipe</span></h1>
    </div>

    <div class="hamburger" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <div class="nav-menu">
      <div class="nav-center">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php">Recipes</a></li>
          <?php if (!$user) { ?>
            <li><a href="register.php">Post Recipe</a></li>
          <?php } else { ?>
            <li><a href="post_recipe.php">Post Recipe</a></li>
          <?php } ?>
          <li><a href="contact_me.php">Contact</a></li>
        </ul>
      </div>
      <div class="nav-right">
        <ul>
          <?php if (!$user) { ?>
            <li><a href="register.php"><button class="register-btn">Register</button></a></li>
            <li><a href="login.php"><button class="login-btn">Login</button></a></li>
          <?php } else { ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"><button type="submit" name="logout-submit" class="logout-btn">Logout</button></form>
          <?php } ?>
        </ul>
      </div>
    </div>

  </div>

  <script>
    function toggleMenu() {
      document.querySelector('.nav-menu').classList.toggle('active');
      // document.querySelectorAll('.hamburger div').forEach((bar, index) => {
      //   bar.classList.toggle(`bar${index + 1}-active`);
      // });
    }
  </script>
</body>

</html>