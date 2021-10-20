<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 16/07/2021
 * Time: 05:51
 */
class Description extends Model
{
    var $table = 'descriptions';
    function saveDesc($data=array()){
        return $this->save($data);
    }
    function nbDesc($data){
        $item_id = '';
        if (count($data)!=0){
            $i = 0;
            for ($i=0; $i<count($data); $i++){
                if ($i==0){
                    $item_id .=$data[$i]['id'];
                }else{
                    $item_id .=','.$data[$i]['id'];
                }
            }
        }
        return $item_id;
    }
}