<p class="menu-label">Admin</p>
<ul class="menu-list">
  <li>
    <a class="<?php echo (isset($_GET["edit"]) && $_GET["edit"] == "movies") ? "is-active" : "" ?>" href="./admin.php?edit=movies">Edit Movies</a>
  </li>
  <li>
    <a class="<?php echo (isset($_GET["edit"]) && $_GET["edit"] == "tickets") ? "is-active" : "" ?>" href="./admin.php?edit=tickets">Edit Tickets</a>
  </li>
  <li>
    <a class="<?php echo (isset($_GET["edit"]) && $_GET["edit"] == "categories") ? "is-active" : "" ?>" href="./admin.php?edit=categories">Edit Categories</a>
  </li>
</ul>