<?php

// session_start();

require "machine.php";

$id = $_GET["id"];

$query = "DELETE FROM `booking` WHERE id = '$id'";

mysqli_query($conn, $query);

header("location:tableBooking.php");


 ?>