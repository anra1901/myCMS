<?php 

require_once "../db.php";

if (isset($_GET['id'])) :

    $id = htmlspecialchars($_GET['id']);
    $sql = "DELETE FROM posts WHERE id = :id";
    $stml = $db -> prepare($sql);
    $stml -> bindParam(':id', $id);
    $stml -> execute(); 

    header("Location: index.php");
    
endif;

header("Location: index.php");

?>