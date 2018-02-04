<?php
namespace Service;
class Validator{

    protected $errors;
    protected $data;

    /**
     * Validator constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->analyserCreationProduit();
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * Prend la variable POST et vérifie les données du formulaire dans
     * views/create.php
     */
    private function analyserCreationProduit()
    {
        extract($_POST);
        if(strlen($nom) < 3)
            $this->errors['nom'] = "Le nom est trop court.";
        if( $prix < 0)
            $this->errors['prix'] = "Le prix doit être positif.";
        if( $stock < 0)
            $this->errors['stock'] = "Le stock doit être positif.";
        if(empty($mois) || $mois < 1 || $mois > 12)
            $this->errors['mois'] = "Le mois doit être compris entre 1 et 12";
        if(empty($type) || $type <=0)
            $this->errors['type'] = "Il faut choisir un type.";
    }

}