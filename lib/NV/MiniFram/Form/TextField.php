<?php
namespace NV\MiniFram\Form;

class TextField extends Field
{
    protected $rows;

    public function buildWidget()
    {
        $widget = '<div class="control-group">
               <div class="form-group floating-label-form-group controls">';

        $widget .= '<label>'.$this->label.'</label>';

        $widget .= '<textarea rows="'.$this->rows.'" class="form-control" placeholder="'.$this->label.'" id="'.$this->name.'" name="'.$this->name.'">';
        if (!empty($this->value)) {
            $widget .= $this->value;
        }
        $widget .= '</textarea>';

        if (!empty($errorMessage)) {
            $widget .= '<p class="help-block text-danger">'.$this->errorMessage.'</p>';
        }

        return $widget .= '</div></div>';
    }

    public function setRows($rows)
    {
        $rows = (int) $rows;

        if ($rows > 0) {
            $this->rows = $rows;
        }
    }
}
