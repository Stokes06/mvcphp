<?php
namespace Repository;
interface RepositoryInterface{
    public function delete($id);
    public function create($object);
    public function update($object);
    public function getById($id);
    public function getAll();
    public function count();
}