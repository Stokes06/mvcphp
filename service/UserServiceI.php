<?php
namespace Service;

use Business\User;
use Repository\FactoryRepository;
use Repository\UserRepository;

class UserServiceI implements UserService{

    /** @var UserRepository  */
    protected $userRepo;
    protected $config;

    /**
     * UserServiceI constructor.
     */
    public function __construct()
    {
        $this->userRepo = FactoryRepository::getRepository("user");
    }

    /**
     * @param mixed $config
     * @return UserServiceI
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function isConnected()
    {
        return $_SESSION['user'] ?? null;
    }

    public function connect($login, $password)
    {
        $user = $this->userRepo->connect($login, $password);
        $_SESSION['user'] = $user;
        return $user;
    }
    public function getUser(){
        return $_SESSION['user'] ?? null;
    }

    public function disconnect()
    {
        unset($_SESSION['user']);
    }
}