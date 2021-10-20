<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14/07/2021
 * Time: 14:42
 */
class fiches extends Controller
{
    var $models = array('Fiche','Categorie','Description');
    function index(){
        $fields = ' f.id as id, f.nom_fiche as nom_fiche,d.description as description,d.id_categorie as id_categorie,d.id as id_desc';
        $join = 'f INNER JOIN descriptions d ON d.id_fiche = f.id';
        $fiches = $this->Fiche->all($fields,$join);
        $d['fiches'] = $fiches;
        $d['categories']= $this->Categorie->getAll();
        $this->set($d);
        $this->render('index');
    }

    function search(){
        $search=isset($_POST['search'])? $_POST['search']:'';
        $fiches = $d['fiches']= $this->Fiche->find(array(
            'fields'  => 'f.id as id, f.nom_fiche as nom_fiche,d.description as description,d.id_categorie as id_categorie,d.id as id_desc',
            'conditions' =>"f.id LIKE '%".$search."%' OR nom_fiche LIKE '%".$search."%'",
            'join' => 'f INNER JOIN descriptions d ON f.id = d.id_fiche ',
            'order' => ' ORDER BY f.id DESC'
        ));
        $d['fiches']=$fiches;
        $d['categories']= $this->Categorie->getAll();
        $d['search']=$search;
        $this->set($d);
        echo json_encode($d);
    }

    function create(){
        $this->render('create');
    }

    function save(){
        $nom_fiche = $_POST['nom_fiche'];
        if (isset($_POST['id'])) {
            $id_fiche = $_POST['id'];
            $fiche = array('id'=> $id_fiche,'nom_fiche'=> $nom_fiche);
        }else{
            $fiche = array('nom_fiche'=> $nom_fiche);
        }
        $this->data = $fiche;
        $getLast = $this->Fiche->save($this->data);
        if ($getLast>0){
            $id_cat = $_POST['id_categorie'];
            $description =$_POST['description'];
            if (isset($_POST['id_desc'])) {
                $id_desc = $_POST['id_desc'];
                $descriptions = array('id'=> $id_desc,'description'=> $description,'id_categorie'=>$id_cat,'id_fiche'=> $getLast['id']);
            }else{
                $descriptions = array('id_categorie'=>$id_cat,'id_fiche'=> $getLast['id'],'description'=> $description);
            }
            $this->data = $descriptions;
            $this->Description->save($this->data);
        }
        $d['fiches']= $this->Fiche->getAll();
        $d['categories']= $this->Categorie->getAll();
        $this->set($d);
        echo json_encode(["data"=>$d]);
    }

    function view($id){
        $fiche= $this->Fiche->find(array(
            'conditions' =>'id='.$id
        ));
        $d['fiche']=$fiche[0];
        $this->set($d);
        $this->render('view');
    }
    function edit($id){
        $fiche= $this->Fiche->find(array(
            'conditions' =>'id='.$id
        ));
        $d['fiche']=$fiche[0];
        $this->set($d);
        $this->render('edit');
    }
    function remove($id){
        $descid = $this->Description->find(array(
            'conditions' =>'id_fiche='.$id
        ));
        $item = $this->Description->nbDesc($descid);
        $this->Fiche->remove($id);
        $this->Description->remove($id," IN (".$item.")");
        //return $this->index();
        echo json_encode(["data"=>'ok'],0,512);
    }
    function indexAjax(){
        $fields = ' f.id as id, f.nom_fiche as nom_fiche,d.description as description,d.id_categorie as id_categorie,d.id as id_desc';
        $join = 'f INNER JOIN descriptions d ON d.id_fiche = f.id';
        $fiches = $this->Fiche->all($fields,$join);
        $d['fiches'] = $fiches;
        $d['categories']= $this->Categorie->getAll();
        $this->set($d);
        echo json_encode(["data"=>$d],0,512);
    }
}