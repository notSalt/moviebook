<?php
session_start();
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
  header("location: login.php");
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
  <title>Moviebook | Dashboard</title>
</head>

<body>
  <!--Navbar START-->
  <nav class="navbar is-white">
    <div class="container">
      <div class="navbar-brand">
        <p class="navbar-item brand-text">Moviebook</p>
      </div>
      <div class="navbar-end">
        <div class="navbar-item">
          <a href="php/logout.php" class="button is-light is-danger">Logout</a>
        </div>
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
            <li>
              <a class="<?php echo (isset($_GET["list"]) && $_GET["list"] == "find") ? "is-active": "" ?>" href="./dashboard.php?list=find">Find Movie</a>
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
        <section class="hero is-info welcome is-small">
          <div class="hero-body">
            <div class="container">
              <h1 class="title">
                Hello, <?php echo $_SESSION["full_name"] ?>.
              </h1>
              <p id="clock" class="subtitle"></p>
            </div>
          </div>
        </section>

        <div class="card has-table">

          <header class="card-header">
            <p class="card-header-title">
              <?php echo isset($_GET["list"]) ? ucfirst($_GET["list"]) : "Please select an option" ?>
            </p>
          </header>
          <div class="card-content">
          <?php
            if (isset($_GET["list"]) && $_GET["list"] == "find") {
              echo "
                <form class=\"form\" action=\"php/find-movie.php\" method=\"post\">
                  <div class=\"field is-grouped\">
                    <p class=\"control is-expanded\">
                      <input required type=\"text\" class=\"input\" placeholder=\"Movie Name\" name=\"movie_name\"
                    </p>
                    <div class=\"control\">
                      <input class=\"button is-success\" type=\"submit\" value=\"Find\">
                    </div>
                  </div>
                </form>
              ";
            }
            ?>
            <br />
            <table class="table is-fullwidth is-bordered">
              <?php
              if (isset($_GET["list"])) {
                switch ($_GET["list"]) {
                  case "tickets":
                    echo "
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Movie Name</th>
                          <th>Cinema</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Seat Number</th>
                        </tr>
                      </thead>
                    ";

                    echo "<tfoot>";
                    $sql = "SELECT ticket_id, movie_name, cinema_name, showing_date, showing_time, seat_id FROM ((tickets INNER JOIN showings ON tickets.showing_id = showings.showing_id) INNER JOIN movies ON showings.movie_id = movies.movie_id) INNER JOIN cinemas ON showings.cinema_id = cinemas.cinema_id WHERE user_id = '" . $_SESSION["user_id"] . "' ";
                    $stmt = mysqli_prepare($link, $sql);
                    if (mysqli_stmt_execute($stmt)) {
                      $result = mysqli_stmt_get_result($stmt);
                      while ($row = mysqli_fetch_array($result)) {
                        echo "
                          <tr>
                            <th>" . $row["ticket_id"] . "</th>
                            <td>" . $row["movie_name"] . "</td>
                            <td>" . $row["cinema_name"] . "</td>
                            <td>" . $row["showing_date"] . "</td>
                            <td>" . $row["showing_time"] . "</td>
                            <td>" . $row["seat_id"] . "</td>
                        ";
                      }
                    }
                    break;
                  case "movies":
                    echo "
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Movie Name</th>
                          <th>Release Date</th>
                          <th>Studio</th>
                          <th>Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    ";

                    echo "<tfoot>";
                    $sql = "SELECT movie_id, movie_name, release_date, studio, categories.category_name FROM movies INNER JOIN categories ON movies.category_id = categories.category_id ORDER BY movie_id ASC";
                    $stmt = mysqli_prepare($link, $sql);
                    if (mysqli_stmt_execute($stmt)) {
                      $result = mysqli_stmt_get_result($stmt);
                      while ($row = mysqli_fetch_array($result)) {
                        echo "
                          <tr>
                            <th>" . $row["movie_id"] . "</th>
                            <td>" . $row["movie_name"] . "</td>
                            <td>" . $row["release_date"] . "</td>
                            <td>" . $row["studio"] . "</td>
                            <td>" . $row["category_name"] . "</td>
                            <td>
                              <a href=\"./dashboard.php?list=movies&selected=" . $row["movie_id"] . "\" class=\"icon has-text-dark\">
                                <i class=\"fa fa-ticket-alt\"></i>
                              </a>
                            </td>
                          </tr>
                        ";
                      }
                    }
                    echo "</tfoot>";
                    break;
                  case "find":
                    echo "
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Movie Name</th>
                          <th>Release Date</th>
                          <th>Studio</th>
                          <th>Category</th>
                        </tr>
                      </thead>
                    ";
                    if (isset($_GET["find"])) {
                      $sql = "SELECT movie_id, movie_name, release_date, studio, categories.category_name FROM movies INNER JOIN categories ON movies.category_id = categories.category_id WHERE movie_id = ?";
                      $stmt = mysqli_prepare($link, $sql);
                      mysqli_stmt_bind_param($stmt, "s", $_GET["find"]);
                      if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        while ($row = mysqli_fetch_array($result)) {
                          echo "
                          <tr>
                            <th>" . $row["movie_id"] . " </th>
                            <td> " . $row["movie_name"] . "</td>
                            <td> " . $row["release_date"] . "</td>
                            <td> " . $row["studio"] . "</td>
                            <td> " . $row["category_name"] . "</td>
                          </tr>
                          ";
                        }
                      }
                    }
                  default:
                    break;
                }
              }
              ?>
            </table>
          </div>

        </div>
      </div>

    </div>
  </div>

  <?php include "components/book-ticket.component.php"?>

  <!--Clock JS-->
  <script src="js/clock.js"></script>
</body>

</html>