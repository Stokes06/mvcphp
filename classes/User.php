<?php

namespace Business;

class User{
    protected $id;
    protected $pseudo;
    protected $password;
    protected $isAdmin;

    /**
     * User constructor.
     * @param $id
     * @param $pseudo
     * @param $password
     */
    public function __construct($id, $pseudo, $password, $isAdmin)
    {   $this->id = $id;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     * @return $this
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     * @return User
     */
    public function setAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }





}