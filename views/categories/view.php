<div class="row">
    <br>
    <br>
    <br>
    <h3 align="center">Detail d'une catégorie</h3>
    <h3><?php echo $category['id_fiche']; ?></h3>
    <h3><?php echo $category['description']; ?></h3>
    <h3><?php echo $category['libelle']; ?></h3>
    <a href="<?php echo WEBROOT;?>categories/remove/<?php echo  $category['id'];?>">Delete</a>
    <a href="<?php echo WEBROOT;?>categories/edit/<?php echo  $category['id'];?>">Edit</a>
    <a href="<?php echo WEBROOT;?>categories/index">List</a>
</div>
