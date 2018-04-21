<?php
namespace NV\MiniFram\Form;

class FileField extends Field
{
    protected $maxSize;

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget .= '<p class="alert alert-danger">'.$this->errorMessage.'</p>';
        }

        $widget .= '<div class="control-group">
               <div class="form-group floating-label-form-group controls">';

        $widget .= '<label>'.$this->label.'</label>';
        if (!empty($this->maxSize)) {
            $widget .= '<input type="hidden" name="MAX_FILE_SIZE" value="'.$this->maxSize.'">';
        }
        $widget .= '<input type="file" class="form-control" placeholder="'.$this->label.'" name = "'.$this->name.'">';

        $widget .= '</div></div>';



        return $widget;
    }

    public function setSize($maxLength)
    {
        $maxSize = (int) $maxSize;

        if ($maxSize > 0) {
            $this->maxSize = $maxSize;
        } else {
            throw new \InvalidArgumentException('The max size must be an intger greated than zero');
        }
    }
}
