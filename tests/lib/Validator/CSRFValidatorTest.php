<?php
namespace Tests\lib\Validator;

use PHPUnit\Framework\TestCase;
use NV\MiniFram\Validator\CSRFValidator;
use NV\MiniFram\Form\CSRFField;

class CSRFValidatorTest extends TestCase
{
    private $field;

    public function setUp()
    {
        $this->field = new CSRFField;
        $this->field->saveToken();
    }

    public function tearDown()
    {
        $this->field = null;
    }

    public function testIsValidTrue()
    {
        $validator = new CSRFValidator('Error');
        $this->assertTrue($validator->isValid($this->field->getValue()));
    }

    public function testIsValidFalse()
    {
        $validator = new CSRFValidator('Error');
        $this->assertFalse($validator->isValid(''));
    }
}
