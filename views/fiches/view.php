<div class="row">
    <br>
    <br>
    <br>
    <h3 align="center">Detail d'un fiche</h3>
    <h3><?php echo $fiche['id']; ?></h3>
    <h3><?php echo $fiche['libelle']; ?></h3>
    <a href="<?php echo WEBROOT;?>fiches/remove/<?php echo  $fiche['id'];?>">Delete</a>
    <a href="<?php echo WEBROOT;?>fiches/edit/<?php echo  $fiche['id'];?>">Edit</a>
    <a href="<?php echo WEBROOT;?>fiches/index">List</a>
</div>