<?php


namespace daxslab\nocaptcha\rules;


class JavascriptGeneratedHiddenFieldRule extends BaseRule
{

    public $name = 'some_name';

    public $parentSelector;

    /**
     * @inheritDoc
     */
    public function render()
    {

        return "<script>
            let parent = document.querySelector('$this->parentSelector');
            parent.innerHTML += \"<input type='hidden' value='1' name='$this->name' tabindex='-1' autocomplete='off' aria-hidden='true'>\";
</script>";
    }

    /**
     * @inheritDoc
     */
    public function checkSubmit()
    {
        $submittedData = $this->getSubmittedData();
        return !(!empty($submittedData) && $submittedData[$this->name] !== "1");
    }
}