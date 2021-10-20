<div class="page-header">
    <h1>Liste <small>Fiches</small></h1>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout de nouvelle fiche</h4>
            </div>
            <form class="form-horizontal" id="add-fiche-form" method="post" action="<?php echo WEBROOT;?>fiches/save">
                <fieldset>
                    <div class="modal-body">
                        <div class="control-group">
                            <label for="nom_fiche" class="control-label">Nom de fiche</label>
                            <div class="controls">
                                <input type="text" placeholder="Nom de fiche" name="nom_fiche"  required id="nom_fiche"  class="span6 form-control">
                            </div>
                            <!-- /controls -->
                        </div>

                        <div class="control-group">
                            <label for="libelle" class="control-label">Description</label>
                            <div class="controls">
                                <input type="text" placeholder="Description" name="description"  required id="description" class="span6 form-control">
                            </div>
                            <!-- /controls -->
                        </div>
                        <div class="control-group">
                            <label for="id_categorie" class="control-label">Catégories</label>
                            <div class="controls">
                                <select name="id_categorie" id="id_categorie" class="span6  form-control">
                                    <?php foreach ($categories as $category){?>
                                        <option value="<?php echo $category['id'];?>"><?php echo $category['nom_categorie'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary <?php if(count($categories)==0) echo 'disabled';?>" type="<?php if(count($categories)==0) {echo 'button';}else{echo 'submit';}?>" id="addfiche">Enregistrer</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<div class="pull-right">
    <form class="form-inline" action="<?php echo WEBROOT;?>fiches/search" method="post">
        <input type="text" class="form-control" name="search" value="<?php echo  isset($search)? $search:'';?>" id="search" placeholder="Chercher votre information"/>
        <button class="btn btn-success"  type="submit">Chercher</button>
        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#myModal">Nouvelle</a>
    </form>
</div>
<br>
<br>

<table id="fiches" class="table table-bordered">
    <thead>
    <tr>
        <th> ID </th>
        <th> Nom de fiche</th>
        <th> Description</th>
        <th width="190px" class="td-actions"> Actions</th>
    </tr>
    </thead>
    <?php
    if (count($fiches)>0){ ?>
    <tbody>
    <?php
    foreach ($fiches as $fiche)
    {
        ?>
        <div id="myModal<?php echo  $fiche['id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modification d'un fiche</h4>
                    </div>
                    <form class="form-horizontal" id="add-fiche-form" method="post" action="<?php echo WEBROOT;?>fiches/save">
                        <fieldset>
                            <input type="hidden" name="id" id="id" value="<?php echo $fiche['id'];?>">
                            <div class="modal-body">
                                <div class="control-group">
                                    <label for="libelle" class="control-label">Nom de fiche</label>
                                    <div class="controls">
                                        <input type="text" placeholder="nom_fiche" name="nom_fiche"  required id="nom_fiche" value="<?php echo isset($fiche['nom_fiche']) ? $fiche['nom_fiche']:''; ?>" class="span6 form-control">
                                    </div>
                                    <!-- /controls -->
                                </div>
                                <div class="control-group">
                                    <label for="libelle" class="control-label">Description</label>
                                    <input type="hidden" name="id_desc" id="id_desc" value="<?php echo $fiche['id_desc'];?>">
                                    <div class="controls">
                                        <input type="text" placeholder="Description" name="description" value="<?php echo $fiche['description']; ?>" required id="description" class="span6 form-control">
                                    </div>
                                    <!-- /controls -->
                                </div>
                                <div class="control-group">
                                    <label for="id_categorie" class="control-label">Catégories</label>
                                    <div class="controls">
                                        <select name="id_categorie" id="id_categorie" class="form-control">
                                            <?php foreach ($categories as $category){?>
                                                <option value="<?php echo $category['id'];?>" <?php if ($category['id'] == $fiche['id_categorie']) echo 'selected ';?>  class=""><?php echo $category['nom_categorie'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <!-- /controls -->
                                </div>
                                <!-- /control-group -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" id="addfiche">Enregistrer</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
        <div id="confirmModal<?php echo  $fiche['id'];?>" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
            <div class="modal-dialog">
                <div style="margin-left: 40px;margin-right: 40px" class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="confirmModalLabel">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="add-delete-form" method="post" action="<?php echo WEBROOT;?>fiches/remove/<?php echo  $fiche['id'];?>">
                            <fieldset>
                                <div class="control-group">
                                    <span align="center" class="control-label">Vous avez supprimé le <?php echo  $fiche['id'];?>?</span>
                                    <!-- /controls -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                                    <button class="btn btn-primary  remove-item" data-id="<?php echo  $fiche['id'];?>" type="submit" id="addfiche">Oui</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <tr id="row_num_<?php echo $fiche['id'];
        ?>">
            <td><a data-toggle="modal" data-target="#myModal<?php echo  $fiche['id'];?>" href="#myModal<?php echo  $fiche['id'];?>"><?php echo $fiche['id']; ?></a></td>
            <td><?php echo $fiche['nom_fiche']; ?></td>
            <td><?php echo $fiche['description'];?></td>
            <td class="td-actions">
                <a class="btn btn-small
btn-success" data-toggle="modal" data-target="#myModal<?php echo  $fiche['id'];?>" href="#myModal<?php echo  $fiche['id'];?>">Modifier<i class="icon-large icon-edit">
                    </i></a>
                <a class="btn btn-danger btn-small" data-toggle="modal" data-target="#confirmModal<?php echo  $fiche['id'];?>" href="#confirmModal<?php echo  $fiche['id'];?>">Supprimer<i class="btn-icon-only icon-remove">
                    </i></a></td>
        </tr>
    <?php } ?>
    </tbody>
    <?php   } else {?>
        <tfoot>
        <tr align="right">
            <td style="border: none"></td>
            <td style="border: none"><label>Aucune donne</label></td>
            <td style="border: none"></td>
            <td style="border: none"></td>
        </tr>
        </tfoot>
    <?php } ?>
    <tbody>

    </tbody>
</table>
<ul id="pagination" class="pagination-sm"></ul>
