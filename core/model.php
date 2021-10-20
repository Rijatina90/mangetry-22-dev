<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 13/07/2021
 * Time: 22:14
 */
class Model
{
    public $table;
    public $id;
    public $db_con;
    public $response = array();
    /**
     * @return mixed
     */
    public function __construct()
    {
        $this->db_con = $_SESSION['db_con'];
    }
    public function all($fields=null,$jointable=null)
    {
        if ($fields==null ){
            $fields = '*';
        }
        $sql = "SELECT ".$fields." FROM ".$this->table;
        if ($jointable!=null){
            $sql .=" ".$jointable;
        }
        try{
            $stm = $this->db_con->prepare($sql);
            $stm->execute();
            $row = $stm->fetchAll(PDO::FETCH_ASSOC);
            if ($stm->rowCount() > 0){
                foreach ($row as $key =>$value){
                    $this->$key = $value;
                }
                return $row;
            }else{
                return [];
            }
        }catch (PDOException $exception){
            echo $exception;die();
        }
    }
    public function save($data){
        if (isset($data["id"]) && !empty($data["id"])){
            $sql = "UPDATE ".$this->table." SET ";
            foreach ($data as $key=>$value){
                $sql .="$key='$value',";
            }
            $sql = substr($sql,0,-1);
            $sql .= "WHERE id=".$data['id'];
        }else{
            $sql = "INSERT INTO";
            $sql .= " ".$this->table."(";
            foreach ($data as $key =>$value){
                $sql .= "$key,";
            }
            $sql = substr($sql,0,-1);
            $sql .= ") VALUE (";
            foreach ($data as $key => $value){
                $sql .= "'$value',";
            }
            $sql = substr($sql,0,-1);
            $sql .= ")";
        }
        //mysqli_query($sql) or die(mysqli_error()."<br/> => ".mysqli_query());
        try{
            $stm = $this->db_con->prepare($sql);
            $stm->execute();
            if (!isset($data['id'])){
                $this->id=$this->db_con->lastInsertId();
                $this->response = array('id'=>$this->id,'action'=>'INSERT');
                return $this->response;
            }else{
                $this->id = $data['id'];
                $this->response = array('id'=>$this->id,'action'=>'UPDATE');
                return $this->response;
            }
        }catch (PDOException $exception){
            if ($this->table=='descriptions'){
                print_r($exception->getMessage());die;
            }
            return $exception;

        }
    }

    public function find($data=array())
    {
        $conditions = "1=1";
        $fields = "*";
        $limit = "";
        $join = "";
        $order_group = "ORDER BY id DESC";
        extract($data);
        if (isset($data["limit"])){
            $limit = "LIMIT ".$data["limit"];
        }
        if (isset($data["order_group"])){
            $order_group = $data["order_group"];
        }
        if (isset($data["join"])){
            $join = " ".$data["join"];
        }
        $sql = "SELECT $fields FROM";
        $sql .= " ".$this->table." ".$join." WHERE $conditions $order_group $limit";
        try{
            $stm = $this->db_con->prepare($sql);
            $stm->execute();
            $row = $stm->fetchAll(PDO::FETCH_ASSOC);
            if ($stm->rowCount() > 0){
                return $row;
            }else{
                return [];
            }
        } catch(PDOException $e) {
            echo 'ERREUR DB CONNEXION';die();
        }
    }

    public  function remove($id=null,$item=null){
        if ($id==null) $id = $this->id;
        $sql = "DELETE FROM";
        if ($item==null){
            $sql .= " ".$this->table." WHERE id=$id";
        }else{
            $sql .= " ".$this->table." WHERE id ".$item;
        }

        try{
            $stm = $this->db_con->prepare($sql);
            $stm->execute();
            if ($this->db_con->lastInsertId()==0){
                return $this->db_con->lastInsertId();
            }else{
                return $this->id;
            }

        }catch (PDOException $exception){
            return $this->all();
        }
    }

}