<?php
namespace NV\MiniFram;

class PDOFactory
{
    const EXTENSIONS = ['mysql'];


    public static function getDatabaseConnexion($data)
    {
        if (in_array(strtolower($data['dms']), self::EXTENSIONS)) {
            $data['dms'] = strtolower($data['dms']);
        } else {
            throw new \InvalidArgumentException('The requested DMS is not compatible.');
        }

        $dms = $data['dms'].':host='.$data['host'].';dbname='.$data['dbname'].';charset=utf8';

        $db = new \PDO($dms, $data['user'], $data['password']);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}
