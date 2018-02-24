<?php
namespace NV;

class PDOFactory
{
    public static function getMysqlConnexion($data)
    {
        $dms = $data['dms'].':host='.$data['host'].';dbname='.$data['dbname'].';charset=utf8';

        return  new \PDO($dms, $data['user'], $data['password']);
    }
}
