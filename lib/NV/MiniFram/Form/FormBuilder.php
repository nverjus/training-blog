<?php
namespace NV\MiniFram\Form;

use NV\MiniFram\Entity;

abstract class FormBuilder
{
    protected $form;

    public function __construct(Entity $entity)
    {
        $this->form = new Form($entity);
    }

    abstract public function build();

    public function getForm()
    {
        return $this->form;
    }
}
