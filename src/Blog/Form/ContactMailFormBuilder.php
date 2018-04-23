<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\TextField;
use NV\MiniFram\Form\StringField;
use NV\MiniFram\Form\EmailField;
use NV\MiniFram\Form\SubmitField;
use NV\MiniFram\Validator\NotNullValidator;
use NV\MiniFram\Validator\MaxLengthValidator;
use NV\MiniFram\Validator\EmailValidator;

class COntactMailFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
          'label' => 'Nom',
          'name' => 'name',
          'maxLength' => 100,
          'validators' => [
            new MaxLengthValidator('Le nom doit pas faire plus de trente caractères', 30),
            new NotNullValidator('Veuillez entrer votre nom'),
          ],
        ]))
        ->add(new StringField([
          'label' => 'Adresse Mail',
          'name' => 'email',
          'validators' => [
            new EmailValidator('Veuillez entrer une adresse email valide'),
            new NotNullValidator('Veuillez entrer une adresse email'),
          ],
       ]))
       ->add(new TextField([
         'label' => 'Message',
         'name' => 'content',
         'rows' => 8,
         'validators' => [
           new NotNullValidator('Vous ne pouvez pas envoyer de message vide'),
         ],
       ]))
       ->add(new SubmitField([
         'value' => 'Envoyer'
       ]));
    }
}
