<?php
namespace Tests\lib\Validator;

use PHPUnit\Framework\TestCase;
use NV\MiniFram\Validator\NotNullValidator;
use NV\MiniFram\Form\StringField;

class StringValidatorTest extends TestCase
{
    public function testMaxLengthoK()
    {
        $field = new StringField(array('maxLength' => 10));
        $this->assertSame(10, $field->getMaxlength());
    }

    public function testMaxLengthZero()
    {
        $this->expectException('InvalidArgumentException');
        $field = new StringField(array('maxLength' => 0));
    }

    public function testMaxLengthNull()
    {
        $this->expectException('InvalidArgumentException');
        $field = new StringField(array('maxLength' => null));
    }

    public function testValidatorsOk()
    {
        $validator = new NotNullValidator('Error');
        $field = new StringField(array(
        'validators' => [
          $validator,
          ],
      ));

        $this->assertTrue(in_array($validator, $field->getValidators()));
    }
}
