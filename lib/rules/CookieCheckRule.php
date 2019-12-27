<?php


namespace daxslab\nocaptcha\rules;


class CookieCheckRule extends BaseRule
{

    /**
     * Name of cookie used for bot checking
     */
    public $name = 'cookie_rule';

    /**
     * Cookie value that will be set
     */
    public $value = true;

    /**
     * @inheritDoc
     */
    public function render()
    {
        setcookie($this->name, $this->value, time() + (86400 * 30), "/"); // 86400 = 1 day
        return "";
    }

    /**
     * @inheritDoc
     */
    public function checkSubmit()
    {
        return (isset($_COOKIE[$this->name]) && $_COOKIE[$this->name] == $this->value);
    }
}