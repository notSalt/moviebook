<?php
session_start();
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
  header("location: login.php");
  exit;
}
if ($_SESSION["is_admin"] !== true) {
  header("location: dashboard.php");
  exit;
}

include_once 'connection.php';

if (isset($_GET)) {
  $sql = "DELETE FROM movies WHERE movie_id = ?";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "s", $movie_id);
  $movie_id = $_GET["movie_id"];
  if (mysqli_stmt_execute($stmt)) {
    header("location: ../admin.php?edit=movies");
  } else {
    echo "Something went wrong. Please try again later.";
  }
} else {
  echo "No parameters given.";
}