<?php
namespace NV;

class PDOFactory
{
    public static function getDatabaseConnexion($config)
    {
        $data = $config->getDatabaseInfos();

        switch ($data['dms']) {
          case 'MySQL':
            $data['dms'] = 'mysql';
            break;
          default:
            throw new \InvalidArgumentException('Only MySQL is compatible.');
            break;
        }

        $dms = $data['dms'].':host='.$data['host'].';dbname='.$data['dbname'].';charset=utf8';

        return  new \PDO($dms, $data['user'], $data['password']);
    }
}
