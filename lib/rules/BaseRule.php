<?php


namespace daxslab\nocaptcha\rules;


use function GuzzleHttp\Psr7\str;

class BaseRule implements RuleInterface
{

    // Possible HTTP methods for $this->method value
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    // Possible random types
    const RANDOM_MD5 = 'RANDOM_MD5';
    const RANDOM_SHA1 = 'RANDOM_SHA1';
    const RANDOM_SHA256 = 'RANDOM_SHA256';
    const RANDOM_UNIQID = 'RANDOM_UNIQID';

    public $name = 'some_name';

    // If a random type, an integer or a list is assigned to $random_name, a random name will be assigned to $name
    public $random_name = null;

    // method used for obtaining submitted data
    public $method = self::METHOD_POST;


    /**
     * @inheritDoc
     * @throws \Exception
     */
    public static function create($config=[])
    {
        $ruleInstance = new static();

        foreach ($config as $name => $value) {
            $ruleInstance->$name = $value;
        }

        $ruleInstance->setRandomName();

        return $ruleInstance;
    }

    /**
     * Returns a random string according $type. If $type is an array will return a random array element.
     * If $type is an integer will return a random string of $type length.
     *
     * @param $type array|string|integer
     * @return string
     * @throws \Exception
     */
    public static function getRandomName($type){
        switch ($type){
            case self::RANDOM_MD5:
                return md5(rand());
            case self::RANDOM_SHA1:
                return sha1(rand());
            case self::RANDOM_SHA256:
                return hash('sha256', rand());
            case self::RANDOM_UNIQID:
                return uniqid();
            case is_array($type):
                return $type[array_rand($type)];
            case is_int($type):
                return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", $type)), 0, $type);
            default:
                throw new \Exception('Unexpected value');
        }
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

    public function setNameInSession(){
        $sessionNameKey = $this->getSessionNameKey();
        $_SESSION[$sessionNameKey] = $this->name;
    }

    public function getNameInSession(){
        $sessionNameKey = $this->getSessionNameKey();
        return isset($_SESSION[$sessionNameKey]) ? $_SESSION[$sessionNameKey] : null;
    }

    /**
     * If $this->random_name is defined will assign a previously random name generated from session
     * or will create a new random name.
     *
     * @throws \Exception
     */
    public function setRandomName(){
        if ($this->random_name){
            $nameInSession = $this->getNameInSession();
            if ($nameInSession){
                $this->name = $nameInSession;
            } else {
                $randomName = self::getRandomName($this->random_name);
                $this->name = $randomName;
                $this->setNameInSession();
            }
        }
    }

    public function getSessionNameKey(){
        return 'name_' . get_called_class();
    }

}