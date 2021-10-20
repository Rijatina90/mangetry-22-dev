<div class="row">
    <br>
    <br>
    <br>
    <h3 align="center">Modification d'une catégorie</h3>
    <form class="form-horizontal" id="add-categorie-form" method="post" action="<?php echo WEBROOT;?>categories/save">
        <fieldset>
            <input type="hidden" name="id" id="id" value="<?php echo $category['id']; ?>">
            <div class="control-group">
                <label for="description" class="control-label">Description</label>
                <div class="controls">
                    <input type="text" placeholder="Description" name="description"  value="<?php echo $category['description']; ?>" required id="description" class="span6 form-control">
                </div>
                <!-- /controls -->
            </div>
            <!-- /control-group -->

            <div class="control-group">
                <label for="libelle" class="control-label">Libelle</label>
                <div class="controls">
                    <input type="text" placeholder="Libelle" name="libelle" value="<?php echo $category['libelle']; ?>"  required id="libelle" class="span6 form-control">
                </div>
                <!-- /controls -->
            </div>
            <!-- /control-group -->

            <div class="control-group">
                <label for="id_fiche" class="control-label">Fiche</label>
                <div class="controls">
                    <select name="id_fiche" class="form-control" id="id_fiche">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <!-- /controls -->
            </div>

            <br>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit" id="annuaire">Save </button> <a class="btn btn-primary" href="<?php echo WEBROOT;?>categories/index">Cancel</a>
            </div>
            <!-- /form-actions -->
        </fieldset>
    </form>
</div>