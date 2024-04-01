<?php
echo "<pre>";
print_r($_POST);

$title = $_POST["title"];
$short = $_POST["short"];
$fee = $_POST["fee"];

$connect = mysqli_connect("localhost","wha","asdf","wad_shop");

$sql = "UPDATE courses SET title='$title',short='$short',fee='$fee'";

$query = mysqli_query($connect,$sql);

var_dump($query);

if($query){
    header("Location:courseCreate.php#tableHeader");
}