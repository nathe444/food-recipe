<?php
include('./config/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url('./images/rdish.jpg');
      background-size: 100% 100%;
      color: white;
      flex-direction: column;
    }

    .container {
      width: 440px;
      padding: 40px;
      background-color: rgb(240, 240, 240);
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      filter: opacity(0.95);
      color: black;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
    }

    button {
      background-color: #4caf50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Login</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</body>

</html>


<?php


session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

  try {
    if ($conn) {
      try {

        $query = "SELECT * FROM users WHERE username = '$username'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          $row = $result->fetch_assoc();
          $hashed_password = $row['password'];
          echo $row['username'] . '<br>' . $row['password'];
          echo $password;
          $compare = password_verify($password, $hashed_password);
          echo $compare;
          if ($compare) {
            // session_start();
            $_SESSION['username'] = $username;
            $_SESSION["logged_in"] = true;
            header("Location: index.php");
            exit();
          } else {
            echo '<script>alert("Invalid username....... or password")</script>';
          }
        } else {
          echo '<script>alert("Invalid username or password")</script>';
        }
      } catch (Exception $e) {
        echo '<script language="javascript">';
        echo 'alert("' . $e->getMessage() . '");';
        echo '</script>';
      }
    }
  } catch (Exception $e) {
    echo '<script language="javascript">';
    echo 'alert("' . $e->getMessage() . '");';
    echo '</script>';
  }
}


?>