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

if (isset($_POST)) {
  $sql = "INSERT INTO movies (movie_name, studio, release_date, category_id) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "sssi", $movie_name, $studio, $release_date, $category_id);
  $movie_name = trim($_POST["movie_name"]);
  $studio = trim($_POST["studio_name"]);
  $release_date = trim($_POST["release_date"]);
  $category_result = mysqli_query($link, "SELECT category_id FROM categories WHERE category_name = '" . $_POST["category_name"] . "'");
  $row = mysqli_fetch_assoc($category_result);
  $category_id = $row["category_id"];

  if (mysqli_stmt_execute($stmt)) {
    header('location: ../admin.php?edit=movies');
  } else {
    echo "Something went wrong. Please try again later.";
  }
} else {
  echo "No parameters given.";
}
?>