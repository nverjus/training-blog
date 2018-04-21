<?php
namespace NV\MiniFram\Form;

class PasswordField extends Field
{
    public function buildWidget()
    {
        $widget = "";

        if (!empty($this->errorMessage)) {
            $widget .= '<p class="alert alert-danger">'.$this->errorMessage.'</p>';
        }
        $widget .= '<div class="control-group">
               <div class="form-group floating-label-form-group controls">';

        $widget .= '<label>'.$this->label.'</label>';
        $widget .= '<input type="password" class="form-control" placeholder="'.$this->label.'"';

        if (!empty($this->value)) {
            $widget .= ' value="'.$this->value.'"';
        }
        $widget .= ' name = "'.$this->name.'">';

        return $widget .= '</div></div>';
    }
}
