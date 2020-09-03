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

include_once 'php/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bulma CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css" integrity="sha512-ADrqa2PY1TZtb/MoLZIZu/Z/LlPaWQeDMBV73EMwjGam43/JJ5fqW38Rq8LJOVGCDfrJeOMS3Q/wRUVzW5DkjQ==" crossorigin="anonymous" />
  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
  <!--Custom CSS-->
  <link rel="stylesheet" href="css/dashboard.css">
  <title>Moviebook | Admin Dashboard</title>
</head>

<body>
  <!--Navbar START-->
  <nav class="navbar is-white">
    <div class="container">
      <div class="navbar-brand">
        <p class="navbar-item brand-text">Moviebook</p>
      </div>
    </div>
  </nav>
  <!--Navbar END-->

  <div class="container">
    <div class="columns">

      <div class="column is-3">
        <aside class="menu">
          <p class="menu-label">General</p>
          <ul class="menu-list">
            <li>
              <a class="<?php echo (isset($_GET["list"]) && $_GET["list"] == "tickets") ? "is-active" : "" ?>" href="./dashboard.php?list=tickets">Your Tickets</a>
            </li>
            <li>
              <a class="<?php echo (isset($_GET["list"]) && $_GET["list"] == "movies") ? "is-active" : "" ?>" href="./dashboard.php?list=movies">Available Movies</a>
            </li>
          </ul>
          <?php
          if ($_SESSION["is_admin"]) {
            include "components/admin-menu.component.php";
          }
          ?>
        </aside>
      </div>

      <div class="column is-9">
        <?php
        if (isset($_GET["edit"])) {
          switch ($_GET["edit"]) {
            case "movies":
              include "components/edit-movie.component.php";
              break;
            default:
              break;
          }
        }
        ?>
      </div>

    </div>
  </div>
</body>

</html>