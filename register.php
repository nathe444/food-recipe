<?php
include('./config/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>
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
    <h1>Register</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="name">First Name:</label>
        <input type="text" id="firstname" name="firstname" required />
      </div>
      <div class="form-group">
        <label for="name">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required />
      </div>
      <div class="form-group">
        <label for="name">User Name:</label>
        <input type="text" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit">Register</button>
    </form>
  </div>

</body>

</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
  $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
  $hash = password_hash($password, PASSWORD_BCRYPT);



  try {

    if ($conn) {
      try {

        $existing_user_query = "SELECT * FROM users WHERE username = '$username'";
        $existing_email_query = "SELECT * FROM users WHERE email = '$email'";

        $existing_user_query_result = mysqli_query($conn, $existing_user_query);

        $existing_email_query_result = mysqli_query($conn, $existing_email_query);

        if (mysqli_num_rows($existing_user_query_result) > 0) {
          echo '<script type="text/javascript">alert("Username already exists");</script>';
        } elseif (mysqli_num_rows($existing_email_query_result) > 0) {
          echo '<script type="text/javascript">alert("Email already exists");</script>';
        } else {
          $sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$hash')";
          $result = mysqli_query($conn, $sql);
          echo '<script type="text/javascript">alert("Registered successfully")</script>';
          header("Location: Login.php");
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