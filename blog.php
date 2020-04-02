<?php

require_once 'db.php';

    $stmt = $db->prepare("SELECT * FROM posts WHERE published > 0 ORDER BY id DESC");
    $stmt->execute();

echo "<div class='row justify-content-center text-center'>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
      $id    = htmlspecialchars($row['id']);
      $title = htmlspecialchars($row['title']);
      $text = htmlspecialchars($row['text']);
      $date = htmlspecialchars($row['date']);
      $image = htmlspecialchars($row['image']);
      $media = $row['media'];
      $published = htmlspecialchars($row['published']);
        ?>

<div class="col-md-10">

        <div class="card">
          <div class="card-body">
            <h2 class="card-title">
              <?= $title; ?>
              </h2>

            <p class="card-text">
              <?php 
              echo str_replace("\r\n", "<p class=card-text>", $text) . "</p>";
              ?>
              </p>
   
        <div>
              <img class="blog-img" src="images/<?= $image ?>" style="max-width: 80%;">
          </div>
  <br>
        <div>
              <?= $media ?>
        </div>

        <div class="card-footer"><?= "Publicerat: $date" ?></div>
          </div>
        </div>
        <br>
    </div>
    
 <?php 
    
    endwhile;
    echo "</div>";

    ?>