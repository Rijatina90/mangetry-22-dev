<div class="page-header">
    <h1>Liste <small>Fiches</small></h1>
</div>
<div id="add-fiche-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout de nouvelle fiche</h4>
            </div>
            <form class="form-horizontal" id="add-fiche-form" method="POST" action="<?php echo WEBROOT;?>fiches/save">
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
                                <textarea name="description" id="description" class="form-control" data-error="Please enter description." required></textarea>
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
                        <button class="btn crud-submit btn-primary <?php if(count($categories)==0) echo 'disabled';?>" type="<?php if(count($categories)==0) {echo 'button';}else{echo 'submit';}?>">Enregistrer</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<div id="edit-fiche-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modification d'un fiche</h4>
            </div>
            <form class="form-horizontal" id="add-fiche-form" method="put" action="<?php echo WEBROOT;?>fiches/save">
                <fieldset>
                    <input type="hidden" name="id" id="id" value=">">
                    <div class="modal-body">
                        <div class="control-group">
                            <label for="libelle" class="control-label">Nom de fiche</label>
                            <div class="controls">
                                <input type="text" placeholder="Nom de fiche" name="nom_fiche"  required id="nom_fiche" class="span6 form-control">
                            </div>
                            <!-- /controls -->
                        </div>
                        <div class="control-group">
                            <label for="libelle" class="control-label">Description</label>
                            <input type="hidden" name="id_desc" id="id_desc">
                            <div class="controls">
                                <textarea name="description" id="description" class="form-control" data-error="Please enter description." required></textarea>
                            </div>
                            <!-- /controls -->
                        </div>
                        <div class="control-group">
                            <label for="id_categorie" class="control-label">Catégories</label>
                            <div class="controls">
                                <select name="id_categorie" id="id_categorie" class="form-control">

                                </select>
                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary crud-submit-edit" data-dismiss="modal" type="submit" id="addfiche">Enregistrer</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>

<div class="pull-right form-inline">
    <input type="text" class="form-control" name="search" value="<?php echo  isset($search)? $search:'';?>" id="search" placeholder="Chercher votre information"/>
    <a class="btn btn-primary" data-toggle="modal" data-target="#add-fiche-form" href="#add-fiche-form">Nouvelle</a>
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
    <tbody>

    </tbody>
</table>
<ul id="pagination" class="pagination-sm"></ul>
