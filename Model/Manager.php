<?php

namespace Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blogs;charset=utf8', 'root', '');
        return $db;
    }
}