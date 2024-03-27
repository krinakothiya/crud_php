<?php
include "connection.php";

$stu_id = $_GET['id'];

$sql = "DELETE FROM students WHERE id = $stu_id";
// $conn->query($sql);
$result = mysqli_query($conn, $sql) or die("query unsuccessful");
// $result = $conn->query($sql) or die("connection is fail");

header("location: http://localhost/crud_php/index.php");
// mysqli_close($conn);
exit;
