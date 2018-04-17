<?php
namespace NV\MiniFram;

class PDOFactory
{
    public static function getDatabaseConnexion($data)
    {
        switch ($data['dms']) {
          case 'MySQL':
            $data['dms'] = 'mysql';
            break;
          default:
            throw new \InvalidArgumentException('Only MySQL is compatible.');
        }

        $dms = $data['dms'].':host='.$data['host'].';dbname='.$data['dbname'].';charset=utf8';

        $db = new \PDO($dms, $data['user'], $data['password']);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}
