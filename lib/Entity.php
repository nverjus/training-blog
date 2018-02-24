<?php
namespace NV;

abstract class Entity
{
    protected $id;

    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    public function isNew()
    {
        if (empty($this->id)) {
            return true;
        }
        return false;
    }

    abstract public function isValid();

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        if ((int) $id > 0) {
            $this->id = (int) $id;
        }
    }
}
