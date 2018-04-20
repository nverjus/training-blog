<?php
namespace NV\MiniFram\Form;

class StringField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = '<div class="control-group">
               <div class="form-group floating-label-form-group controls">';

        $widget .= '<label>'.$this->label.'</label>';
        $widget .= '<input type="text" class="form-control" placeholder="'.$this->label.'"';

        if (!empty($this->value)) {
            $widget .= ' value="'.$this->value.'"';
        }
        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="'.$this->maxLength.'"';
        }
        $widget .= ' name = "'.$this->name.'">';

        if (!empty($errorMessage)) {
            $widget .= '<p class="help-block text-danger">'.$this->errorMessage.'</p>';
        }

        return $widget .= '</div></div>';
    }

    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;

        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \InvalidArgumentException('The max length must be an intger greated than zero');
        }
    }
}
