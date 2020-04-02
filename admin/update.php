<?php
require_once "../db.php";

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
        $currentImage = $row["image"];
        $currentMedia = $row["media"];
        $published = htmlspecialchars($row["published"]);

    } else {
        header("Location: ../index.php");
        exit;
    }
    
} else {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER ["REQUEST_METHOD"] === "POST") {
    
    require_once "upload.php";
    
    $title = $_POST["title"];
    $text = $_POST["text"];
    if (empty($_FILES["image"]["name"])) {
        //$image = $_POST["image"];
        $image = $currentImage;
        } else {
        $image = basename($_FILES["image"]["name"]);
    }
    $media = $_POST["media"];
    $published = $_POST["published"];
    $id = $_GET["id"];

    $sql = "UPDATE posts 
            SET title = :title, text = :text, image = :image, media = :media, published = :published
            WHERE id = :id";
            
    $stml = $db -> prepare($sql);
    $stml -> bindParam(":id", $id);
    $stml -> bindParam(":title", $title);
    $stml -> bindParam(":text", $text);
    $stml -> bindParam(":image", $image);
    $stml -> bindParam(":media", $media);
    $stml -> bindParam(":published", $published);
    $stml -> execute();

    header("Location: ../index.php");
}
require_once "header-admin.php";?>

<h2 style="margin: 30px 0">Redigera</h2>

<form action="#" method="post" enctype="multipart/form-data">

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
<h6>Nuvarande bild:</h6> 
<img src="../images/<?= $currentImage ?>" style="max-width:25%;">
<p>Filnamn: <?= $currentImage ?></p>
<br>
<label for="image">Ladda upp en bild:</label>
  <input type="file" 
        name="image" 
        class="form-control mb-4"
        value='<?= $currentImage ?>'>
  <br>
  <label for="media">Lägg till en inbäddad länk för karta eller video:</label>
  <input type="text" 
        name="media" 
        class="form-control mb-4"
        value='<?= $currentMedia ?>'>

   <input 
        type="hidden" 
        name="id" 
        value="<?=$id?>"> 
        <br>
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
            <?= isPublished($published) ?>>
    <label for="published">Publicera</label>
<br>
    <input 
        type="submit"
        class="form-control my-2 btn btn-success"
        value="Uppdatera inlägg"
        style="width:300px">
</form>
<button class="btn btn-danger">
    <a href="index.php" style="color:white; text-decoration:none">Avbryt</a>
  </button>

<?php require_once "../footer.php"; ?>