<?php


namespace daxslab\nocaptcha\rules;


class CssHiddenFieldRule extends BaseRule
{

    /**
     * Name of input used for hidden field
     */
    public $name = 'some_name';

    /**
     * @inheritDoc
     */
    public function render()
    {
        return "<input type='checkbox' name='$this->name' tabindex='-1' autocomplete='off' aria-hidden='true'>
                                <style>
                                    input[name=$this->name] {
                                        display: none !important;
                                    }
                                </style>";
    }

    /**
     * @inheritDoc
     */
    public function checkSubmit()
    {
        $submittedData = $this->getSubmittedData();
        return !(!empty($submittedData[$this->name]) && $submittedData[$this->name] == True);
    }
}