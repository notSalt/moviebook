<?php
include_once "connection.php";
if ($_POST["movie_name"]) {
    $sql = "SELECT movie_id FROM movies WHERE movie_name LIKE ?";
    $stmt = mysqli_prepare($link, $sql);
    $param = "%{$_POST["movie_name"]}%";
    mysqli_stmt_bind_param($stmt, "s", $param);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $found = mysqli_num_rows($result);
        if ($found > 0) {
            $row = mysqli_fetch_array($result);
            $id = $row["movie_id"];
            header("location:../dashboard.php?list=find&find=$id");
        } else {
            header("location:../dashboard.php?list=find");
        }
    }
}
?>