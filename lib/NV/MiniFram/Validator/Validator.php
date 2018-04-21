<?php
namespace NV\MiniFram\Validator;

abstract class Validator
{
    protected $errorMessage;

    public function __construct($errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }

    abstract public function isValid($value);

    public function setErrorMessage($errorMessage)
    {
        if (is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
