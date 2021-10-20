<div class="page-header">
    <h1>Liste <small>Catégories</small></h1>
</div>

<div class="pull-right">
    <form class="form-inline" action="<?php echo WEBROOT;?>categories/search" method="post">
        <?php if(isset($action)) {?>
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Modification avec succées!</strong>
        </div>
        <?php } ?>
        <input type="text" class="form-control" name="search" value="<?php echo  isset($search)? $search:'';?>" id="search" placeholder="Chercher votre information"/>
        <button class="btn btn-success"  type="submit">Chercher</button>
        <a class="btn btn-primary " data-toggle="modal" data-target="#myModal" href="#myModal">Nouvelle</a>
    </form>
</div>
<br>
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th> ID </th>
        <th> Nom de catégorie</th>
        <th> Nombre de fiche</th>
        <th width="190px" class="td-actions">Actions </th>
    </tr>
    </thead>
    <?php
    if (count($categories)>0){ ?>
    <tbody>
    <?php
    foreach ($categories as $category)
    {
        ?>
        <tr id="row_num_<?php echo $category['id'];
        ?>">
            <td><a data-toggle="modal" data-target="#detailModal<?php echo  $category['id'];?>" href="#detailModal<?php echo  $category['id'];?>"><?php echo $category['id']; ?></a></td>
            <td><?php echo $category['nom_categorie']; ?></td>
            <td><?php if (count($descriptions)!=0) {foreach ($descriptions as $description) { if ($description['id_categorie'] == $category['id']) echo $description['nb'];}}?></td>
            <td class="td-actions">
                <a class="btn btn-small
btn-success" data-toggle="modal" data-target="#myModal<?php echo  $category['id'];?>" href="#myModal<?php echo  $category['id'];?>">Modifier<i class="icon-large icon-edit">
                    </i></a>
                <a class="btn btn-danger btn-small" data-toggle="modal" data-target="#confirmModal<?php echo  $category['id'];?>" href="#confirmModal<?php echo  $category['id'];?>">Supprimer<i class="btn-icon-only icon-remove">
                    </i></a></td>
        </tr>
        <!-- / Modification d'une catégorie -->
        <div id="myModal<?php echo isset($category['id']) ? $category['id']:''; ?>" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div style="margin-left: 40px;margin-right: 40px" class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modification d'une catégorie</h4>
                    </div>
                    <form class="form-horizontal" id="add-categorie-form" method="post" action="<?php echo WEBROOT;?>categories/save">
                        <fieldset>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?php echo $category['id']; ?>">
                                <div class="control-group">
                                    <label for="nom_categorie" class="control-label">Nom de catégorie</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Nom de catégorie" name="nom_categorie"   required id="nom_categorie" value="<?php echo isset($category['nom_categorie']) ? $category['nom_categorie']:''; ?>" class="span6 form-control">
                                    </div>
                                    <!-- /controls -->
                                </div>
                                <!-- /control-group -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit" id="addfiche">Enregistrer</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>

        <!-- / Affichage d'une catégorie -->
        <div id="detailModal<?php echo isset($category['id']) ? $category['id']:''; ?>" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div style="margin-left: 40px;margin-right: 40px" class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Detail d'une catégorie</h4>
                    </div>
                    <form class="form-horizontal" id="add-categorie-form" method="post" action="<?php echo WEBROOT;?>categories/save">
                        <fieldset>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?php echo $category['id']; ?>">
                                <div class="control-group">
                                    <label for="nom_categorie" class="control-label">Nom de catégorie</label>
                                    <div class="controls">
                                        <input type="text" readonly="true" placeholder="Nom de catégorie" name="nom_categorie"   required id="nom_categorie" value="<?php echo isset($category['nom_categorie']) ? $category['nom_categorie']:''; ?>" class="span6 form-control">
                                    </div>
                                    <!-- /controls -->
                                </div>
                                <!-- /Description -->
                                <label id="description_cat" for="nom_categorie" accesskey="<?php echo $category['id']; ?>" class="control-label">Fiches</label>
                                <div id="description_catr" class="control-group">
                                    <input type="hidden" name="description_cat" id="description_cat" value="<?php echo $category['id']; ?>">
                                    <label for="nom_categorie" class="control-label">Nom de catégorie</label>
                                    <div class="controls">
                                        <input type="text" readonly="true" placeholder="Nom de catégorie" name="nom_categorie"   required id="nom_categorie" value="<?php echo isset($category['nom_categorie']) ? $category['nom_categorie']:''; ?>" class="span6 form-control">
                                    </div>
                                    <!-- /controls -->
                                </div>
                                <!-- /control-group -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit" id="addfiche">Enregistrer</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
        <!-- /Confirmation -->
        <div id="confirmModal<?php echo  $category['id'];?>" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
            <div class="modal-dialog">
                <div style="margin-left: 40px;margin-right: 40px" class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="confirmModalLabel">Confirmation</h4>
                    </div>
                    <form class="form-horizontal" id="add-delete-form" method="post" action="<?php echo WEBROOT;?>categories/remove/<?php echo  $category['id'];?>">
                        <fieldset>
                            <div class="modal-body">
                                <div class="control-group">
                                    <span align="center" class="control-label">Vous avez supprimé le <?php echo  $category['id'];?>?</span>
                                    <!-- /controls -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                                <button class="btn btn-primary" type="submit" id="addfiche">Oui</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    <?php } ?>

    </tbody>
    <?php   } else {?>
        <tfoot>
        <tr align="center">
            <td style="border: none"></td>
            <td style="border: none"></td>
            <td style="border: none"><label align="center">Aucune donne</label></td>
            <td style="border: none"></td>
            <td style="border: none"></td>
        </tr>
        </tfoot>
    <?php } ?>
    <div id="myModal" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div style="margin-left: 40px;margin-right: 40px" class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ajout de nouvelle catégorie</h4>
                </div>
                <form class="form-horizontal" id="add-categorie-form" method="post" action="<?php echo WEBROOT;?>categories/save">
                    <fieldset>
                        <div class="modal-body">
                            <div class="control-group">
                                <label for="nom_categorie" class="control-label">Nom de catégorie</label>
                                <div class="controls">
                                    <input type="text" placeholder="Nom de catégorie" name="nom_categorie"   required id="nom_categorie" class="form-control">
                                </div>
                                <!-- /controls -->
                            </div>
                        </div>
                        <!-- /control-group -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit" id="addfiche">Enregistrer</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</table>
<ul id="pagination" class="pagination-sm"></ul>