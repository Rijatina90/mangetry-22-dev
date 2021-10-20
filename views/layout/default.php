<!DOCTYPE html>
<html>
<head>
    <title>Gestion de catégories et de fiches</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link href="../../css/navbar-fixed-top.css" rel="stylesheet">
    
    <script type="text/javascript" src="../../js/jquery.js"></script>

    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var url = "http://miniannuaire.mg/";
    </script>
    <script src="../../js/ajax.js"></script>
    <script src="../../js/category.js"></script>

    <div class="container">
        <nav class="navbar navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand active" style="cursor: none" href="<?php echo WEBROOT;?>">Gestion de catégories & de fiches</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?php if ($_SESSION['nav_active'] =='fiches') echo 'active';?>"><a href="<?php echo WEBROOT;?>fiches/index">Fiches</a></li>
                        <li class="<?php if ($_SESSION['nav_active'] =='categories') echo 'active';?>"><a href="<?php echo WEBROOT;?>categories/index">Categories</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
        <br>
        <?php echo $content_layout; ?>
    </div>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/modal.js"></script>
    <script src="../../js/jquery.js"></script>
