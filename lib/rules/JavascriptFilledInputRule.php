<?php


namespace daxslab\nocaptcha\rules;


class JavascriptFilledInputRule extends BaseRule
{

    public $name = 'javascript_filled';

    public $inputValue = 'somevalue';

    /**
     * @inheritDoc
     */
    public function render()
    {

        return "<input type='hidden' name='$this->name' tabindex='-1' autocomplete='off' aria-hidden='true'>
                <script>
                    let input = document.querySelector('input[name=$this->name]');
                    input.value = '$this->inputValue';
                </script>";
    }

    /**
     * @inheritDoc
     */
    public function checkSubmit()
    {
        $submittedData = $this->getSubmittedData();
        return (!empty($submittedData[$this->name]) && $submittedData[$this->name] == $this->inputValue);
    }
}