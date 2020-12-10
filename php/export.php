<?php  
//export.php  
include_once 'connection.php';
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM movies INNER JOIN categories ON movies.category_id = categories.category_id";
 $result = mysqli_query($link, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
    <tr>  
        <th>ID</th>  
        <th>Movie Name</th>  
        <th>Release Date</th>  
        <th>Studio</th>
        <th>Category</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
        <td>'.$row["movie_id"].'</td>  
        <td>'.$row["movie_name"].'</td>  
        <td>'.$row["release_date"].'</td> 
        <td>'.$row["studio"].'</td> 
        <td>'.$row["category_name"].'</td>
    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
