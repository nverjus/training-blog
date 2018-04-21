<?php
namespace Tests\lib\Validator;

use PHPUnit\Framework\TestCase;
use NV\MiniFram\Validator\NotNullValidator;

class NotNullValidatorTest extends TestCase
{
    public function testIsValidTrue()
    {
        $validator = new NotNullValidator('Error');
        $this->assertTrue($validator->isValid('aaaa'));
    }

    public function testIsValidFalse()
    {
        $validator = new NotNullValidator('Error');
        $this->assertFalse($validator->isValid(''));
    }
}
