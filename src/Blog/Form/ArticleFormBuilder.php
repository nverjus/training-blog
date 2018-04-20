<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\TextField;
use NV\MiniFram\Form\StringField;
use NV\MiniFram\Form\FileField;
use NV\MiniFram\Form\SubmitField;

class ArticleFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
      'label' => 'Titre',
      'name' => 'title',
      'maxLength' => 100,
    ]))
    ->add(new StringField([
      'label' => 'Sous-Titre',
      'name' => 'subTitle',
      'maxLength' => 100,
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
    ]))
    ->add(new SubmitField([
      'value' => 'Envoyer'
    ]));
    }
}
