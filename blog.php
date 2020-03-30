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
      //$image = htmlspecialchars($row['image']);
      $media = htmlspecialchars($row['media']);
      $published = htmlspecialchars($row['published']);

      // Skapa src till img-taggen
      if($image): 
        $image = "images/$image";
        endif;

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

            <img class="card-img-top"
                src="<?= $image; ?>"
                alt="<?= $title; ?>">

        <iframe class="card-img-top" src="<?php $media; ?>"></iframe><br>
        <div class="card-footer"><?= "Publicerat: $date" ?></div>
          </div>
        </div>
    </div>

 <?php 
    
    endwhile;
    echo "</div>";

    ?>