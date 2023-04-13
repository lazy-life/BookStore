<?php
$connect = mysqli_connect('localhost', 'root', '', 'bookstore');
if ($connect) {
    echo "";
}
//Step 2: Write query to load limit 10 books to home screen.
$id = $_GET["id"];
$sql = "DELETE FROM book WHERE BookID = '$id'";
//Step 3: Execute query and save result to var $result
$result = mysqli_query($connect, $sql);
//display books to screen

echo"<script>window.open('admin.php','_self')</script>";
?>
