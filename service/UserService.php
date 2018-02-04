<?php
namespace Service;
interface UserService
{
    public function isConnected();

    public function connect($login, $password);

    public function disconnect();
}