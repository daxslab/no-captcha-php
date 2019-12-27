<?php
namespace daxslab\nocaptcha\rules;

interface RuleInterface
{

    /**
     * Returns a rule instance based on config
     *
     * @param $config
     * @return object
     */
    public static function create($config);

    /**
     * Returns the rendered form fields used for rule checking
     *
     * @return string
     */
    public function render();


    /**
     * Returns true if current submit triggers the rule validation
     *
     * @return boolean
     */
    public function checkSubmit();

}