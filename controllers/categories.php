<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14/07/2021
 * Time: 01:15
 */
class categories extends Controller
{
    var $models = array('Categorie','Description','Fiche');
    function index(){
        $categories = $this->Categorie->getAll();
        $d['categories']= $categories;
        if ($categories!=null){
            $item_cat = $this->Description->nbDesc($categories);
            $descriptions = $this->Description->find(array(
                    'fields'  => 'COUNT(c.id) as nb, d.id as id,c.nom_categorie as nom_categorie,d.description as description,d.id_categorie as id_categorie,d.id as id_desc',
                    'join' => 'd INNER JOIN categories c ON id_categorie = c.id',
                    'conditions' => "`id_categorie` IN (".$item_cat.")",
                    'order_group' => ' GROUP BY id_categorie'
                )
            );
            $d['descriptions']= $descriptions;

        }
        $this->set($d);
        $this->render('index');
    }

    function search(){
        $search=isset($_POST['search'])? $_POST['search']:'';
        $categories = $this->Categorie->find(array(
            'conditions' =>"`id` LIKE '%".$search."%' OR `nom_categorie` LIKE '%".$search."%'"
        ));
        $d['categories'] = $categories;
        $d['search']=$search;
        if ($categories!=null){
            $item_cat = $this->Description->nbDesc($categories);
            $descriptions = $this->Description->find(array(
                    'fields'  => 'COUNT(c.id) as nb, d.id as id,c.nom_categorie as nom_categorie,d.description as description,d.id_categorie as id_categorie,d.id as id_desc',
                    'join' => 'd INNER JOIN categories c ON id_categorie = c.id',
                    'conditions' => "`id_categorie` IN (".$item_cat.")",
                    'order_group' => ' GROUP BY id_categorie'
                )
            );
            $d['descriptions']= $descriptions;
        }
        $this->set($d);
        //$this->render('index');
        echo json_encode($d);
    }

    function create(){
        $this->render('create');
    }

    function save(){
        $this->data = $_POST;
        $getLast = $this->Categorie->save($this->data);
        $categories = $this->Categorie->getAll();
        $d['categories']= $categories;
        if ($categories!=null){
            $item_cat = $this->Description->nbDesc($categories);
            $d['descriptions']= $this->Description->find(array(
                    'conditions' => "`id_categorie` IN (".$item_cat.")"
                )
            );
        }
        if (isset($getLast['action'])) $d['action']= $getLast['action'];
        $this->set($d);
        if (isset($getLast['action'])) {
            header('Location: /categories',false,302);
        }else{
            header('Location: /categories');
        }
        return $this->index();
    }

    function view($id){
        $categorie = $this->Categorie->find(array(
            'conditions' =>'id='.$id
        ));
        $d['category']= $categorie[0];
        $this->set($d);
        $this->render('view');
    }
    function edit($id){
        $categorie = $this->Categorie->find(array(
            'conditions' =>'id='.$id
        ));
        $d['category']= $categorie[0];
        $this->set($d);
        $this->render('edit');
    }
    function remove($id){
        $descid = $this->Description->find(array(
            'conditions' =>'id_categorie='.$id
        ));
        $item = $this->Description->nbDesc($descid);
        $this->Categorie->remove($id);
        $this->Description->remove($id," IN (".$item.")");
        $this->Fiche->remove($id," IN (".$item.")");
        return $this->index();
    }
}