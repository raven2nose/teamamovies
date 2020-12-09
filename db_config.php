<?php

$servername = "sql204.epizy.com";
$username = "epiz_27394024";
$password = "AfiQOT8hneuOyFr";
$database = "epiz_27394024_teamamovies";

// Create connection
$db = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

?>