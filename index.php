<?php
	define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
	define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
    require (ROOT.'core/model.php');
    require (ROOT.'core/controller.php');
    include_once('database/Connexion.php');
    $homecotroller = isset($_GET['p']) ? $_GET['p']:'home';
    if (strlen($_SERVER['REQUEST_URI'])==1) $homecotroller ='fiches';
    $params = explode('/', $homecotroller);
    $controller = $params[0];
    $_SESSION['db_con'] = $db_con;
    $_SESSION['nav_active']=$controller;
    $action = isset($params[1]) ? $params[1]:'index';
    $action = str_replace('.php','',$action);

if (file_exists(ROOT.'controllers/'.$controller.'.php')){
        require ('controllers/'.$controller.'.php');
        $controller = new $controller();
        if (method_exists($controller,$action)){
            unset($params[0]);
            unset($params[1]);
            call_user_func_array(array($controller,$action),$params);
            $_POST = null;
            //$controller->$action();
        }else{
            die('Error Method not exist');
        }
    }else{
        die('Erreur File not exist');;
    }

?>