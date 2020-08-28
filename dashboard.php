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
              <a class="<?php echo $_GET["list"] == "tickets" ? "is-active" : "" ?>" href="./dashboard.php?list=tickets">Your Tickets</a>
            </li>
            <li>
              <a class="<?php echo $_GET["list"] == "movies" ? "is-active" : "" ?>" href="./dashboard.php?list=movies">Available Movies</a>
            </li>
          </ul>
        </aside>
      </div>

      <div class="column is-9">
        <section class="hero is-info welcome is-small">
          <div class="hero-body">
            <div class="container">
              <h1 class="title">
                Hello, <?php echo $_SESSION["full_name"] ?>.
              </h1>
              <h2 class="subtitle">
                I hope you are having a great day!
              </h2>
            </div>
          </div>
        </section>

        <div class="card has-table">

          <header class="card-header">
            <p class="card-header-title">
              <?php echo isset($_GET["list"]) ? ucfirst($_GET["list"]) : "Table" ?>
            </p>
          </header>

          <div class="notification is-card-toolbar">
            <div class="levels">
              <div class="level-right">

                <form>
                  <div class="field has-addons">
                    <div class="control"><input type="text" placeholder="Search" class="input"></div>
                    <div class="control">
                      <button type="submit" class="button is-primary"><span class="icon"><i class="fa fa-search"></i></span></button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>

          <div class="card-content">
            <table class="table is-fullwidth">
              <thead>
                <th>ID</th>
                <th>Movie Name</th>
                <th>Release Date</th>
                <th>Studio</th>
                <th>Category</th>
              </thead>
              <tbody>
                <?php
                $results = mysqli_query($link, "SELECT * FROM movies INNER JOIN categories ON movies.category_id=categories.category_id ORDER BY movies.movie_id");
                while ($row = mysqli_fetch_array($results)) {
                  print "<tr>";
                  print "<th>".$row["movie_id"]."</th>";
                  print "<td>".$row["movie_name"]."</td>";
                  print "<td>".$row["release_date"]."</td>";
                  print "<td>".$row["studio"]."</td>";
                  print "<td>".$row["category_name"]."</td>";
                  print "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>

    </div>
  </div>
</body>

</html>