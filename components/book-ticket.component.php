<?php
if (isset($_GET["selected"])) {
  $sql = "SELECT movie_id, movie_name FROM movies WHERE movie_id = ?";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "s", $_GET["selected"]);
  if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $movie_id, $movie_name);
    mysqli_stmt_fetch($stmt);
  }
}
?>

<div class="modal <?php echo isset($_GET["selected"]) ? "is-active" : "" ?>">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Book Ticket</p>
      <a href="dashboard.php?list=movies" class="delete"></a>
    </header>
    <section class="modal-card-body">
      <form id="ticketform" action="php/book-ticket.php" method="post">

        <div class="field">
          <label class="label" for="movie_name">Movie Name</label>
          <div class="control">
            <input type="text" name="movie_name" class="input" value="<?php echo $movie_name ?>" disabled>
          </div>
        </div>

        <div class="field">
          <label for="showing_id" class="label">Showings</label>
          <div class="control">
            <div class="select">
              <select name="showing_id">
                <?php
                $sql = "SELECT showings.showing_id, showings.showing_date, showings.showing_time, cinemas.cinema_name FROM showings INNER JOIN cinemas ON showings.cinema_id = cinemas.cinema_id WHERE showings.movie_id = ?";
                $stmt = mysqli_prepare($link, $sql);
                mysqli_stmt_bind_param($stmt, "s", $movie_id);
                if (mysqli_stmt_execute($stmt)) {
                  $result = mysqli_stmt_get_result($stmt);
                  while ($row = mysqli_fetch_array($result)) {
                    $showing_id = $row["showing_id"];
                    $showing_date = $row["showing_date"];
                    $showing_time = $row["showing_time"];
                    $cinema_name = $row["cinema_name"];
                    echo "<option value='$showing_id'>$cinema_name $showing_date $showing_time</option>";
                  }
                }
                ?>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label for="seat_id" class="label">Seat Number</label>
          <div class="control">
            <input type="text" name="seat_id" class="input">
          </div>
        </div>

      </form>
    </section>
    <footer class="modal-card-foot">
      <input type="submit" class="button is-success" form="ticketform" value="Order Ticket">
      <a href="dashboard.php?list=movies" class="button">Cancel</a>
    </footer>
  </div>
</div>