<?php


namespace daxslab\nocaptcha\rules;


class FormTimeTrapRule extends BaseRule
{

    /**
     * Name of input used for hidden field
     *
     * @var string
     */
    public $name = 'time_form';

    /**
     * Name of input used for hidden field
     *
     * @var integer
     */
    public $time = 3;

    /**
     * Method used by openssl_encrypt
     *
     * @var string
     */
    public $encryptMethod = 'AES-128-ECB';

    /**
     * Encrypt key used by openssl_encrypt
     *
     * @var string
     */
    public $encryptKey = 'verySecretOne';

    /**
     * @inheritDoc
     */
    public function render()
    {
        $currentTimestamp = time();
        $encryptedTimestamp = openssl_encrypt($currentTimestamp, $this->encryptMethod, $this->encryptKey);
        return "<input type='hidden' name='$this->name' value='$encryptedTimestamp' tabindex='-1' autocomplete='off' aria-hidden='true'>";
    }

    /**
     * @inheritDoc
     */
    public function checkSubmit()
    {

        $submittedData = $this->getSubmittedData();
        if ($submittedData){
            $encryptedStartTimestamp = $submittedData[$this->name];
            $startTimestamp = openssl_decrypt($encryptedStartTimestamp, $this->encryptMethod, $this->encryptKey);
            $currentTimestamp = time();
            $interval = $currentTimestamp - $startTimestamp;

            if (!$startTimestamp || $interval <= $this->time){
                return false;
            }
        }
        return true;
    }
}