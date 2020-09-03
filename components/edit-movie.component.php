<div class="card">

  <header class="card-header">
    <p class="card-header-title">Add Movie</p>
  </header>
  <div class="card-content">
    <form action="php/add-movie.php" class="form" method="POST">
      <div class="field is-grouped">
        <p class="control is-expanded">
          <input type="text" class="input" placeholder="Movie Name" name="movie_name">
        </p>
        <p class="control">
          <input type="text" class="input" placeholder="Studio Name" name="studio_name">
        </p>
        <p class="control">
          <input type="date" class="input" placeholder="Release Date" name="release_date">
        </p>
        <div class="control">
          <div class="select">
            <select name="category_name">
              <?php
              $sql = "SELECT category_name FROM categories";
              $stmt = mysqli_prepare($link, $sql);
              if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_array($result)) {
                  $category_name = $row["category_name"];
                  echo "<option value='$category_name'>$category_name</option>";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="control">
          <input class="button is-success" type="submit">
        </div>
      </div>
    </form>
  </div>

</div>

<div class="card">
  <header class="card-header">
    <p class="card-header-title">Edit Movies</p>
  </header>
  <div class="card-content">
    <table class="table is-striped is-hoverable is-fullwidth is-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Movie Name</th>
          <th>Release Date</th>
          <th>Studio</th>
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tfoot>
        <?php
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
                <a href=\"./admin.php?edit=movies&movie_id=" . $row["movie_id"] . "\" class=\"icon has-text-dark\">
                  <i class=\"fas fa-edit\"></i>
                </a>
                <a href=\"./php/delete-movie.php?movie_id=" . $row["movie_id"] . "\" class=\"icon has-text-danger\">
                  <i class=\"fas fa-trash\"></i>
                </a>
              </td>
            </tr>
          ";
          }
        }
        ?>
      </tfoot>
    </table>
  </div>
</div>

<?php
if (isset($_GET["movie_id"])) {
  $sql = "SELECT movie_id, movie_name, release_date, studio, category_id FROM movies WHERE movie_id = ?";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "s", $_GET["movie_id"]);
  if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $movie_id, $movie_name, $release_date, $studio, $category_id);
    mysqli_stmt_fetch($stmt);
  }
}
?>

<div class="modal <?php echo isset($_GET["movie_id"]) ? "is-active" : "" ?>">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Edit Movie</p>
      <a href="admin.php?edit=movies" class="delete"></a>
    </header>
    <section class="modal-card-body">
      <form id="editform" action="php/edit-movie.php" method="post">

        <div class="field">
          <label class="label" for="movie_id">Movie ID</label>
          <div class="control">
            <input type="text" name="movie_id" class="input" value="<?php echo $movie_id ?>" readonly>
          </div>
        </div>

        <div class="field">
          <label for="movie_name" class="label">Movie Name</label>
          <div class="control">
            <input type="text" name="movie_name" class="input" value="<?php echo $movie_name ?>">
          </div>
        </div>

        <div class="field">
          <label for="release_date" class="label">Release Date</label>
          <div class="control">
            <input type="date" name="release_date" class="input" value="<?php echo $release_date ?>">
          </div>
        </div>

        <div class="field">
          <label for="studio" class="label">Studio</label>
          <div class="control">
            <input type="text" name="studio" class="input" value="<?php echo $studio ?>">
          </div>
        </div>

        <div class="field">
          <label for="category" class="label">Category</label>
          <div class="control">
            <div class="select">
              <select name="category_name">
                <?php
                $sql = "SELECT * FROM categories";
                $stmt = mysqli_prepare($link, $sql);
                if (mysqli_stmt_execute($stmt)) {
                  $result = mysqli_stmt_get_result($stmt);
                  while ($row = mysqli_fetch_array($result)) {
                    $option_id = $row["category_id"];
                    $option_name = $row["category_name"];
                    if ($option_id == $category_id) {
                      echo "<option selected value='$option_name'>$option_name</option>";
                    } else {
                      echo "<option value='$option_name'>$option_name</option>";
                    }
                  }
                }
                ?>
              </select>
            </div>
          </div>
        </div>

      </form>
    </section>
    <footer class="modal-card-foot">
      <input type="submit" class="button is-success" form="editform" value="Save Changes">
      <a href="admin.php?edit=movies" class="button">Cancel</a>
    </footer>
  </div>
</div>