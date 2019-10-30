<?php
namespace Gilles\Blog\Model;

class Manager
{

    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=billets;charset=utf8', 'root', '');
        return $db;
    }

}
