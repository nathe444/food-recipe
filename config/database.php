<?php

$SERVER = "localhost";
$USER = "root";
$PASS = "";
$DB = "recipeDB";

$conn = "";

try {
  $conn = mysqli_connect($SERVER, $USER, $PASS, $DB);
  echo '<script type="text/javascript">console.log("Successfully connected to the database.");</script>';
} catch (Exception $e) {
  echo '<script language="javascript">';
  echo 'alert("' . $e->getMessage() . '");';
  echo '</script>';
}
