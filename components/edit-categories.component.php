<div class="card">
  <header class="card-header">
    <p class="card-header-title">Edit Movies</p>
  </header>
  <div class="card-content">
    <table class="table is-striped is-hoverable is-fullwidth is-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Category Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tfoot>
        <?php
        $sql = "SELECT category_id, category_name FROM categories";
        $stmt = mysqli_prepare($link, $sql);
        if (mysqli_stmt_execute($stmt)) {
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_array($result)) {
            echo "
            <tr>
              <th class=\"is-narrow\">" . $row["category_id"] . "</th>
              <td>" . $row["category_name"] . "</td>
              <td class=\"is-narrow\">
                <a href=\"./admin.php?edit=categories&category_id=" . $row["category_id"] . "\" class=\"icon has-text-dark\">
                  <i class=\"fas fa-edit\"></i>
                </a>
                <a href=\"./php/delete-category.php?category_id=" . $row["category_id"] . "\" class=\"icon has-text-danger\">
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