<!DOCTYPE html>
<?php include_once("incl/config.php"); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHO MySQLI Pagination</title>
</head>
<body>
<?php
// connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db($conn, 'pagination');
// define how many results you want per page
$results_per_page = 10;
// find out the number of results stored in database
$sql='SELECT * FROM alphabet';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page
$sql='SELECT * FROM alphabet LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)) {
  echo $row['id'] . ' ' . $row['alphabet']. '<br>';
}
$prev1 = $page-2;
$prev = $page-1;
$next = $page+1;
$next1 = $page+2;
echo '
<nav aria-label="Page navigation example">
 <ul class="pagination justify-content">
   <li class="page-item">
     <a class="page-link" href="index.php?page=1" tabindex="1">&laquo;</a>
   </li>
   <li class="page-item">
     <a class="page-link" href="index.php?page='.$prev.'" tabindex="-1">Previous</a>
   </li>
   <li class="page-item"><a class="page-link" href="index.php?page='.$prev1.'">'.$prev1.'</a></li>
   <li class="page-item"><a class="page-link" href="index.php?page='.$prev.'">'.$prev.'</a></li>
   <li class="page-item"><a style="background-color: #ddd;" class="page-link" href="index.php?page='.$page.'">'.$page.'</a></li>
   <li class="page-item"><a class="page-link" href="index.php?page='.$next.'">'.$next.'</a></li>
   <li class="page-item"><a class="page-link" href="index.php?page='.$next1.'">'.$next1.'</a></li>
   <li class="page-item">
     <a class="page-link" href="index.php?page='.$next.'">Next</a>
   </li>
   <li class="page-item">
     <a class="page-link" href="index.php?page='.$number_of_pages.'">&raquo;</a>
   </li>
  </ul>
 </nav>';
 
?>
</body>
</html>
