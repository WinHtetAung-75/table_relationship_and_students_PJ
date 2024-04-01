<?php
echo "<pre>";
// print_r($_POST);

$name = $_POST["name"];
$id = $_POST["id"];
$course_id = $_POST["course_id"];
$student_limit = $_POST["student_limit"];
$start_date = $_POST["start_date"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$is_register_open = isset($_POST["is_register_open"]) ? $_POST["is_register_open"] : 0;

$connect = mysqli_connect("localhost", "wha", "asdf", "wad_shop");

$sql = "UPDATE batches SET name='$name',course_id=$course_id,start_date='$start_date',start_time='$start_time',end_time='$end_time',student_limit=$student_limit, is_register_open = $is_register_open WHERE id = $id ";

$query = mysqli_query($connect, $sql);
var_dump($query);
if ($query) {
    header("Location:batchList.php");
}
