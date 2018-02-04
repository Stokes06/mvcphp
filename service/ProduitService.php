<?php
namespace Service;
interface ProduitService{
    public function delete($id);
    public function create($nom, $prix, $stock, $mois, $type, $image);
    public function update($id, $nom, $prix, $stock, $mois, $type, $image);
    public function getById($id);
    public function getAll($page);
    public function count();

}