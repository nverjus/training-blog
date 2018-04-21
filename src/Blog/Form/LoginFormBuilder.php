<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\StringField;
use NV\MiniFram\Form\PasswordField;
use NV\MiniFram\Form\SubmitField;
use NV\MiniFram\Validator\NotNullValidator;

class LoginFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
          'label' => 'Identifiant',
          'name' => 'username',
          'validators' => [
            new NotNullValidator('Veuillez entrer un identifiant'),
          ],
        ]))
        ->add(new PasswordField([
          'label' => 'Mot de Passe',
          'name' => 'password',
       ]))
       ->add(new SubmitField([
         'value' => 'Se Connecter'
       ]));
    }
}
