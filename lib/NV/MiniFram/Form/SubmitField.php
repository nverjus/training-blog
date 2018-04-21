<?php
namespace NV\MiniFram\Form;

class SubmitField extends Field
{
    public function buildWidget()
    {
        $widget = '<div class="control-group">
               <div class="form-group floating-label-form-group controls">';

        $widget .=  '<button type="submit" class="btn btn-primary" id="sendMessageButton">';

        if (!empty($this->value)) {
            $widget .= $this->value.'</button>';
        } else {
            throw new \InvalidArgumentException('SubmitField must have a value');
        }

        return $widget .= '</div></div>';
    }
}
