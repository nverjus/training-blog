<?php
namespace NV\MiniFram\Form;

class SubmitField extends Field
{
    protected $classes = "btn btn-primary";

    public function buildWidget()
    {
        $widget = '<div class="control-group">
               <div class="form-group floating-label-form-group controls">';

        $widget .=  '<button type="submit" id="sendMessageButton"';

        if (!empty($this->classes)) {
            $widget .= ' class="'.$this->classes.'"';
        }
        $widget .= '>';

        if (empty($this->value)) {
            throw new \InvalidArgumentException('SubmitField must have a value');
        }
        $widget .= $this->value.'</button>';


        return $widget .= '</div></div>';
    }

    public function setClasses($classes)
    {
        if (!is_string($classes)) {
            throw new \InvalidArgumentException('Classes must be a string');
        }
        $this->classes = $classes;
    }
}
