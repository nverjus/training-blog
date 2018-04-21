<?php
namespace Tests\lib\Validator;

use PHPUnit\Framework\TestCase;
use NV\MiniFram\Validator\MaxLengthValidator;

class MaxLengthValidatorTest extends TestCase
{
    public function testMaxLengthoK()
    {
        $validator = new MaxLengthValidator('Error', 10);
        $this->assertSame(10, $validator->getMaxlength());
        $this->assertSame('Error', $validator->getErrorMessage());
    }

    public function testMaxLengthZero()
    {
        $this->expectException('InvalidArgumentException');
        $validator = new MaxLengthValidator('Error', 0);
    }

    public function testMaxLengthNull()
    {
        $this->expectException('InvalidArgumentException');
        $validator = new MaxLengthValidator('Error', null);
    }

    public function testIsValidTrue()
    {
        $validator = new MaxLengthValidator('Error', 5);
        $this->assertTrue($validator->isValid('aaaa'));
    }

    public function testIsValidFalse()
    {
        $validator = new MaxLengthValidator('Error', 5);
        $this->assertFalse($validator->isValid('aaaaaaaaa'));
    }
}
