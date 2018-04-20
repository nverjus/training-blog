<?php
namespace NV\MiniFram;

abstract class File extends Entity
{
    protected $adress;

    public function setAdress($adress)
    {
        if (!empty($adress) && is_string($adress)) {
            $this->adress = $adress;
        }
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function uploadFile($file, $uploadDir)
    {
        $uploadDir = __DIR__.'/../../../'.$uploadDir;
        $extension= strtolower(substr(strrchr($file['name'], '.'), 1));
        $fileName = md5(uniqid()) .".". $extension;
        $fileRoad = $uploadDir.$fileName;
        if (move_uploaded_file($file['tmp_name'], $fileRoad)) {
            $this->adress = $fileName;
        }
        return null;
    }

    public function removeFile($uploadDir)
    {
        unlink(__DIR__.'/../../../'.$uploadDir.$this->adress);
        $this->adress = null;
    }
}
