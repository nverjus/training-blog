<?php
namespace NVFram;

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

        return  new \PDO($dms, $data['user'], $data['password']);
    }
}
