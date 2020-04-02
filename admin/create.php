<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

    require_once "../db.php";
    require_once "upload.php";

$title = htmlspecialchars($_POST["title"]);
$text = htmlspecialchars($_POST["text"]);
$image = basename($_FILES["image"]["name"]);
$media = $_POST["media"];
$published = htmlspecialchars($_POST["published"]);

$stmt = $db -> prepare("INSERT INTO posts (title, text, image, media, published) 
                        VALUES (:title, :text, :image, :media, :published)");

$stmt -> bindParam(":title", $title);
$stmt -> bindParam(":text", $text);
$stmt -> bindParam(":image", $image);
$stmt -> bindParam(":media", $media);
$stmt -> bindParam(":published", $published);

$stmt -> execute();

header("Location:index.php");
exit;

endif;
require_once "header-admin.php";
?>

<h2 style="margin: 30px 0">Nytt inlägg</h2>

<form action="#" method="post" enctype="multipart/form-data">

    <label for="titel">Rubrik
    <br>
        <input 
            type="text" 
            name="title" required
            id="title"
            class="form-control my-2"
            placeholder="Ange rubrik">
    </label>
<br>
    <label for="text">Text<br>
        <textarea 
            name="text" 
            id="text" 
            cols="80" 
            rows="10" 
            placeholder="Vad har du på hjärtat?"></textarea>
    </label>
<br>

<label for="image">Ladda upp en bild:</label>
  <input type="file" name="image" class="form-control mb-4">
  <br>
  <label for="media">Lägg till en inbäddad länk för karta eller video:</label>
  <input type="text" name="media" class="form-control mb-4">

 <input 
            type="hidden" 
            name="published" 
            id="hidden-published"
            value=0>
    <input 
            type="checkbox" 
            name="published" 
            id="published"
            value=1
            checked>
    <label for="published">Publicera</label>
    <br>
   <input 
        type="hidden" 
        name="id" 
        value="<?=$id?>"> 
<br>
    <input 
        type="submit"
        class="form-control my-2 btn btn-success"
        value="Skapa inlägg"
        style="width:300px">
</form>
<br>