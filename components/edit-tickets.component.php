<div class="card">
  <header class="card-header">
    <p class="card-header-title">Edit Movies</p>
  </header>
  <div class="card-content">
    <table class="table is-striped is-hoverable is-fullwidth is-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Seat ID</th>
          <th>Movie Name</th>
          <th>User Name</th>
          <th>Cinema</th>
          <th>Date</th>
          <th>Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tfoot>
        <?php
        $sql = "SELECT * FROM ";
        $stmt = mysqli_prepare($link, $sql);
        if (mysqli_stmt_execute($stmt)) {
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_array($result)) {
            echo "
            <tr>
              <th>" . $row["ticket_id"] . "</th>
              <td>" . $row["seat_number"] . "</td>
              <td>" . $row["movie_name"] . "</td>
              <td>" . $row["first_name"] . " " . $row["last_name"] . "</td>
              <td>" . $row["cinema_name"] . "</td>
              <td>" . $row["Date"] . "</td>
              <td>" . $row["Time"] . "</td>
              <td>
                <a href=\"./admin.php?edit=tickets&ticket_id=" . $row["ticket_id"] . "\" class=\"icon has-text-dark\">
                  <i class=\"fas fa-edit\"></i>
                </a>
                <a href=\"./php/delete-ticket.php?ticket_id=" . $row["ticket_id"] . "\" class=\"icon has-text-danger\">
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