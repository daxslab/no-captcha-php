<?php


namespace daxslab\nocaptcha\rules;


class BaseRule implements RuleInterface
{

    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    public $name = 'some_name';

    public $method = self::METHOD_POST;


    /**
     * @inheritDoc
     */
    public static function create($config)
    {
        $ruleInstance = new static();

        foreach ($config as $name => $value) {
            $ruleInstance->$name = $value;
        }

        return $ruleInstance;
    }

    /**
     * Return submission data according with specified method
     *
     * @return array|null
     */
    public function getSubmittedData(){
        if ($this->method == self::METHOD_POST){
            return $_POST;
        } elseif ($this->method == self::METHOD_GET){
            return $_GET;
        }
        return null;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function render()
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function checkSubmit()
    {
        throw new \Exception('Not implemented');
    }
}