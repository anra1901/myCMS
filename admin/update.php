<?php 

require_once "../db.php";
require_once "header-admin.php";

function isPublished($published) {
    $checked = "";
    if ($published == 1) {
        $checked = "checked";
    } else {
        $checked =  $checked;
    }
    return $checked;
}

if (isset($_GET["id"])) {

$id = htmlspecialchars($_GET["id"]);
$stmt = $db -> prepare("SELECT * FROM posts WHERE id=:id");
$stmt -> bindParam(":id", $id);
$stmt -> execute();

    if ($stmt -> rowCount() > 0) {
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $title = htmlspecialchars($row["title"]);
        $text = htmlspecialchars($row["text"]);
        // $image = htmlspecialchars($row["image"]);
        $media = htmlspecialchars($row["media"]);
        $published = htmlspecialchars($row["published"]);

    } else {
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}

if ($_SERVER ["REQUEST_METHOD"] === "POST") :
    $title = $_POST["title"];
    $text = $_POST["text"];
    //$image = $_POST["image"];
    $media = $_POST["media"];
    $published = $_POST["published"];
    $id = $_GET["id"];

    $sql = "UPDATE posts 
            SET title = :title, text = :text, media = :media, published = :published
            WHERE id = :id";
            
    $stml = $db -> prepare($sql);
    $stml -> bindParam(":id", $id);
    $stml -> bindParam(":title", $title);
    $stml -> bindParam(":text", $text);
    // $stml -> bindParam(":image", $image);
    $stml -> bindParam(":media", $media);
    $stml -> bindParam(":published", $published);
    $stml -> execute();

    header("Location: index.php");
endif;

?>

<h2 style="margin: 30px 0">Redigera inlägg</h2>

<form action="#" method="post">

    <label for="titel">Rubrik
    <br>
        <input 
            type="text" 
            name="title" required
            id="title"
            class="form-control my-2"
            value="<?= $title ?>">
    </label>
<br>
    <label for="text">Text<br>
        <textarea 
            name="text" 
            id="text" 
            cols="80" 
            rows="10"><?= $text ?></textarea>
    </label>
<br>

<!-- 
<form action="upload.php" method="post" enctype="multipart/form-data">
    Välj en bild:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" name="submit" value="Ladda upp bilden">
</form>
<br> -->

<label for="media">Lägg till media (karta/film)<br>
        <textarea 
            name="media" 
            id="media" 
            cols="80" 
            rows="5"><?= $media ?></textarea>
    </label>

   <input 
        type="hidden" 
        name="id" 
        value="<?=$id?>"> 
        <br>
        <input 
            type="checkbox" 
            name="published" 
            id="published"
            value=1
            <?= isPublished($published) ?>>
    <label for="published">Publicera</label>
<br>
    <input 
        type="submit"
        class="form-control my-2 btn btn-success"
        value="Publicera inlägg"
        style="width:300px">
</form>

<?php

require_once "../footer.php";

?>