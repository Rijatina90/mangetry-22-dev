<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 13/07/2021
 * Time: 21:28
 */
class Categorie extends Model
{
    var $table = 'categories';
    function getAll(){
        return $this->all();
    }
}