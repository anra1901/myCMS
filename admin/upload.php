<?php

require_once "../db.php";

$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
?>