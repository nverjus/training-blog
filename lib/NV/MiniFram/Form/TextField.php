<?php
namespace NV\MiniFram\Form;

class TextField extends Field
{
    protected $rows;

    public function buildWidget()
    {
        $widget = "";
        if (!empty($this->errorMessage)) {
            $widget .= '<p class="alert alert-danger">'.$this->errorMessage.'</p>';
        }
        $widget .= '<div class="control-group">
               <div class="form-group floating-label-form-group controls">';

        $widget .= '<label>'.$this->label.'</label>';

        $widget .= '<textarea rows="'.$this->rows.'" class="form-control" placeholder="'.$this->label.'" id="'.$this->name.'" name="'.$this->name.'">';
        if (!empty($this->value)) {
            $widget .= $this->value;
        }
        $widget .= '</textarea>';

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
