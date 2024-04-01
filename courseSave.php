<?php
echo "<pre>";
print_r($_POST);

$title = $_POST["title"];
$short = $_POST["short"];
$fee = $_POST["fee"];

//to connect the database
$connect = mysqli_connect("localhost", "wha", "asdf", "wad_shop");

//sql statement
$sql = "INSERT INTO courses (title,short,fee) VALUES ('$title','$short','$fee')";

//query run
$query = mysqli_query($connect, $sql);

var_dump($query);

if ($query) {
    header("Location:courseCreate.php");
}
