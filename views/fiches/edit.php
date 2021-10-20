<div class="row">
    <br>
    <br>
    <br>
    <h3 align="center">Modification d'un fiche</h3>
    <form class="form-horizontal" id="add-fiche-form" method="post" action="<?php echo WEBROOT;?>fiches/save">
        <fieldset>
            <input type="hidden" name="id" id="id" value="<?php echo $fiche['id']; ?>">
            <div class="control-group">
                <label for="libelle" class="control-label">Libelle</label>
                <div class="controls">
                    <input type="text" placeholder="Libelle" name="libelle" value="<?php echo $fiche['libelle']; ?>"  required id="libelle" class="span6 form-control">
                </div>
                <!-- /controls -->
            </div>
            <!-- /control-group -->
            <br>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit" id="addfiche">Save</button>
                <a class="btn btn-primary" href="<?php echo WEBROOT;?>fiches/index">Cancel</a>
            </div>
            <!-- /form-actions -->
        </fieldset>
    </form>
</div>