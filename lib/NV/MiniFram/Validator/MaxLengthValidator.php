<?php
namespace NV\MiniFram\Validator;

class MaxLengthValidator extends Validator
{
    protected $mexLength;

    public function __construct($errorMessage, $maxLength)
    {
        parent::__construct($errorMessage);
        $this->setMaxLength($maxLength);
    }

    public function isValid($value)
    {
        return strlen($value) <= $this->maxLength;
    }

    public function getMaxlength()
    {
        return $this->maxLength;
    }

    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;
        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \InvalidArgumentException('maxLength must be an integer greater than zero');
        }
    }
}
