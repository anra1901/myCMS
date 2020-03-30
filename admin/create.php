
<?php

require_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

$title = htmlspecialchars($_POST["title"]);
$text = htmlspecialchars($_POST["text"]);
$image = htmlspecialchars($_POST["image"]);
$media = htmlspecialchars($_POST["media"]);
$published = htmlspecialchars($_POST["published"]);

$stmt = $db -> prepare("INSERT INTO posts (title, text, image, media, published) 
                        VALUES (:title, :text, :image, :media, :published)");

$stmt -> bindParam(":title", $title);
$stmt -> bindParam(":text", $text);
$stmt -> bindParam(":image", $image);
$stmt -> bindParam(":media", $media);
$stmt -> bindParam(":published", $published);

$stmt -> execute();

header("Location:../index.php");

endif;

?>

<h2 style="margin: 30px 0">Nytt inlägg</h2>

<form action="#" method="post">

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
            rows="5" 
            placeholder="Klistra in URL"></textarea>
    </label>
<br>
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
        value="Publicera inlägg"
        style="width:300px">
</form>

<?php 



?>