<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 13/07/2021
 * Time: 21:28
 */
class Fiche extends Model
{
    var $table = 'fiches';
    function getAll(){
        return $this->all();
    }
}