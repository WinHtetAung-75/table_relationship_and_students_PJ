<?php
echo "<pre>";

print_r($_POST);

$name = $_POST["name"];
$id = $_POST["student_id"];
$gender = $_POST["gender"];
$course_id = $_POST["course_id"];
$batch_id = $_POST["batch_id"];

$connect = mysqli_connect("localhost", "wha", "asdf", "wad_shop");

$sql = "UPDATE students SET name='$name',gender='$gender',course_id='$course_id',batch_id='$batch_id' WHERE id=$id";

$query = mysqli_query($connect, $sql);

var_dump($query);

if($query){
    header("Location:studentLists.php");
}
