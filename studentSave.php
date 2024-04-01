<?php
echo "<pre>";
print_r($_POST);

$name = $_POST["name"];
$gender = $_POST["gender"];
$course_id = $_POST["course_id"];
$batch_id = $_POST["batch_id"];

//to connect database
$connect = mysqli_connect("localhost", "wha", "asdf", "wad_shop");
print_r($connect);

//sql statement just String
$sql = "INSERT INTO students (name,gender,course_id,batch_id) VALUES ('$name','$gender','$course_id','$batch_id')";

//query function Run
$query = mysqli_query($connect, $sql);

// if($query){
//     header("Location:index.php");
// }

if ($query) {
    header("Location:studentLists.php");
}
