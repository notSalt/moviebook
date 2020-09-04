<?php
session_start();
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
  header("location: login.php");
  exit;
}

include_once 'connection.php';

if (isset($_POST)) {
  $sql = "INSERT INTO tickets (showing_id, user_id, seat_id) VALUES (?, ?, ?)";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "iss", $showing_id, $user_id, $seat_id);
  $showing_id = $_POST["showing_id"];
  $user_id = $_SESSION["user_id"];
  $seat_id = trim($_POST["seat_id"]);

  if (mysqli_stmt_execute($stmt)) {
    header("location: ../dashboard.php?list=movies");
  } else {
    echo "Something went wrong. Please try again later.";
  }
} else {
  echo "No parameters given.";
}