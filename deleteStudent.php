<?php
echo "<pre>";

print_r($_GET);
$id = $_GET["id"];

//to connect the database
$connect = mysqli_connect("localhost", "wha", "asdf", "wad_shop");

//to write sql statement just String
$sql = "DELETE FROM students WHERE id = $id";

//query function Run
$query = mysqli_query($connect, $sql);

if ($query) {
    header("Location:studentLists.php");
}
