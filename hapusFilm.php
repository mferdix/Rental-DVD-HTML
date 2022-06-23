<?php

// session_start();

require "machine.php";

$id = $_GET["id"];

$query = "DELETE FROM `filmlist` WHERE id = '$id'";

mysqli_query($conn, $query);

header("location:filmList.php");


 ?>