<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 01/02/2018
 * Time: 14:40
 */

namespace Service;


interface TypeProduitService
{
    public function getById($id);
    public function getAll();
}