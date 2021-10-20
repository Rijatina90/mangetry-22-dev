<div class="page-header">
    <h1>Liste <small>Catégories</small></h1>
</div>

<div class="pull-right form-inline">
    <input type="text" class="form-control" name="search" id="search" placeholder="Chercher votre information"/>
    <a class="btn btn-primary " data-toggle="modal" data-target="#createModalCategory" href="#createModalCategory">Nouvelle</a>
</div>
<br>
<br>
<table id="category" class="table table-bordered">
    <thead>
        <tr>
            <th> ID </th>
            <th> Nom de catégorie</th>
            <th> Nombre de fiche</th>
            <th width="190px" class="td-actions">Actions </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div id="createModalCategory" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <button class="btn btn-primary crud-submit-category" type="submit" id="addfiche">Enregistrer</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<!-- / Modification d'une catégorie -->
<div id="editModalCategory" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div style="margin-left: 40px;margin-right: 40px" class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modification d'une catégorie</h4>
            </div>
            <form class="form-horizontal" id="add-categorie-form" method="post" action="<?php echo WEBROOT;?>categories/save">
                <fieldset>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="control-group">
                            <label for="nom_categorie" class="control-label">Nom de catégorie</label>
                            <div class="controls">
                                <input type="text" placeholder="Nom de catégorie" name="nom_categorie"   required id="nom_categorie" class="span6 form-control">
                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary crud-submit-category-modif" type="submit" id="addfiche">Enregistrer</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>

<!-- / Affichage d'une catégorie -->
<div id="detailModalCategory" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                <input type="text" readonly="true" placeholder="Nom de catégorie" name="nom_categorie"   required id="nom_categorie" class="span6 form-control">
                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /Description -->
                        <label id="description_cat" for="nom_categorie" class="control-label">Fiches</label>
                        <div id="description_catr" class="control-group">
                            <input type="hidden" name="description_cat" id="description_cat">
                            <label for="nom_categorie" class="control-label">Nom de catégorie</label>
                            <div class="controls">
                                <input type="text" readonly="true" placeholder="Nom de catégorie" name="nom_categorie"   required id="nom_categorie" class="span6 form-control">
                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<!-- /Confirmation -->
<div id="supprModalCategory" class="modal fade col-md-offset-0" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
    <div class="modal-dialog">
        <div style="margin-left: 40px;margin-right: 40px" class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirmModalLabel">Confirmation</h4>
            </div>
            <fieldset>
                <div class="modal-body">
                    <div class="control-group">
                        <span align="center" class="control-label">Vous avez supprimé le>?</span>
                        <!-- /controls -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button class="btn btn-primary" type="submit" id="addfiche">Oui</button>
                </div>
            </fieldset>

        </div>
    </div>
</div>

<ul id="pagination" class="pagination-sm"></ul>