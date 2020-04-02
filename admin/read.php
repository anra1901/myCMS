<?php 

require_once "../db.php";

$stmt = $db->prepare("SELECT * FROM posts ORDER BY id DESC");
$stmt->execute();

$table = "<table class='table'>";
$table .= "<tr>
            <th>ID</th>
            <th>Rubrik</th>
            <th>Datum</th>
            <th>Status</th>
            <th></th>
            </tr>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $date = htmlspecialchars($row['date']);
    $published = htmlspecialchars($row['published']);

    if ($published == 1) {
        $published = "publicerat";
    } else {
        $published = "avpublicerat";
    }

    $table .= "<tr>
            <td>$id</td>
            <td>$title</td>
            <td>$date</td>
            <td>$published</td>
            <td>
            <a href='update.php?id=$id' class='btn btn-info'>Redigera</a>
            <a href='delete.php?id=$id' class='btn btn-danger'>Ta bort</a>
            </td></tr>";
}
$table .= "</table>";
echo $table;

?>