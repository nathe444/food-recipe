<?php
include('./partials/header.php');
include('./config/database.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Contact Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ff6b6b, #ffcc33);
      background-image: url('./images/contact-image.jpg');
      background-size: cover;
      background-repeat: no-repeat;
    }

    .container {
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, rgba(255, 255, 230, 0.83), rgba(255, 209, 200, 0.85));
    }

    .contact-section {
      width: 100%;
      max-width: 1200px;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      border-radius: 10px;
      padding: 50px;
      overflow: hidden;
    }

    .contact-info {
      color: #333;
      max-width: 500px;
      font-size: 18px;
      padding-left: 50px;
      line-height: 2;
    }

    .contact-info i {
      margin-right: 20px;
      font-size: 25px;
    }

    .contact-form {
      max-width: 600px;
      width: 100%;
    }

    .contact-form h2 {
      color: #333;
      text-align: center;
      font-size: 35px;
      text-transform: uppercase;
      margin-bottom: 30px;
    }

    .contact-form .text-box {
      background: rgba(0, 0, 0, 0.2);
      color: #fff;
      border: none;
      width: calc(50% - 10px);
      height: 50px;
      padding: 12px;
      font-size: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
      transition: background 0.3s;
    }

    .contact-form .text-box:first-child {
      margin-right: 15px;
    }

    .contact-form .text-box:focus {
      background: rgba(0, 0, 0, 0.38);
    }

    .contact-form textarea {
      background: rgba(0, 0, 0, 0.2);
      color: #fff;
      border: none;
      width: 100%;
      padding: 12px;
      font-size: 15px;
      min-height: 200px;
      max-height: 400px;
      resize: vertical;
      border-radius: 5px;
      margin-bottom: 20px;
      transition: background 0.3s;
    }

    .contact-form textarea:focus {
      background: rgba(0, 0, 0, 0.38);
    }

    .contact-form .send-btn {
      float: right;
      background: #ff5722;
      color: #fff;
      border: none;
      width: 120px;
      height: 40px;
      font-size: 15px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 2px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .contact-form .send-btn:hover {
      background: #f44336;
    }

    @media screen and (max-width: 950px) {
      .contact-section {
        flex-direction: column;
        padding: 30px;
      }

      .contact-info {
        margin-bottom: 30px;
        padding-left: 0;
      }

      .contact-form .text-box {
        width: 100%;
      }
    }

    .alert-success {
      z-index: 1;
      background: #D4EDDA;
      font-size: 18px;
      padding: 20px 40px;
      min-width: 420px;
      position: fixed;
      right: 0;
      top: 10px;
      border-left: 8px solid #3AD66E;
      border-radius: 4px;
    }

    .alert-error {
      z-index: 1;
      background: #FFF3CD;
      font-size: 18px;
      padding: 20px 40px;
      min-width: 420px;
      position: fixed;
      right: 0;
      top: 10px;
      border-left: 8px solid #FFA502;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <!-- Alert messages (hidden by default) -->
  <!-- 
  <div class="alert-success">
    <span>Message Sent! Thank you for contacting us.</span>
  </div>
  <div class="alert-error">
    <span>Something went wrong! Please try again.</span>
  </div>
  -->

  <!-- Contact section -->

  <div class="container">
    <div class="contact-section">
      <div class="contact-info">
        <div><i class="fas fa-map-marker-alt"></i>AA, Ethiopia</div>
        <div><i class="fas fa-envelope"></i>natnaelmulugeta1116@gmail.com</div>
        <div><i class="fas fa-phone"></i>+251 993 944 704</div>
        <div><i class="fas fa-clock"></i>Mon - Fri 9:00 AM to 4:00 PM</div>
      </div>
      <div class="contact-form">
        <h2>Contact Us</h2>
        <form class="contact" action="" method="post">
          <input type="text" name="name" class="text-box" placeholder="Your Name" required>
          <input type="email" name="email" class="text-box" placeholder="Your Email" required>
          <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
          <input type="submit" name="submit" class="send-btn" value="Send">
        </form>
      </div>
    </div>
  </div>

</body>

</html>