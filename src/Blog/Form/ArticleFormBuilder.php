<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\TextField;
use NV\MiniFram\Form\StringField;
use NV\MiniFram\Form\FileField;
use NV\MiniFram\Form\SubmitField;
use NV\MiniFram\Validator\NotNullValidator;
use NV\MiniFram\Validator\MaxLengthValidator;

class ArticleFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
          'label' => 'Titre',
          'name' => 'title',
          'maxLength' => 100,
          'validators' => [
            new MaxLengthValidator('Le titre ne doit pas faire plus de cent caractères', 100),
            new NotNullValidator('L\'article doit avoir un titre'),
          ],
        ]))
        ->add(new StringField([
          'label' => 'Sous-Titre',
          'name' => 'subTitle',
          'maxLength' => 100,
          'validators' => [
            new MaxLengthValidator('Le sous-titre ne doit pas faire plus de cent caractères', 100),
          ],
       ]))
       ->add(new FileField([
         'label' => 'Image d\'en tête',
         'name' => 'image',
         'maxSize' => 4000000,
       ]))
       ->add(new TextField([
         'label' => 'Article',
         'name' => 'content',
         'rows' => 8,
         'validators' => [
           new NotNullValidator('L\'article doit avoir un contenu'),
         ],
       ]))
       ->add(new SubmitField([
         'value' => 'Envoyer',
       ]));
    }
}
