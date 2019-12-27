<?php


namespace daxslab\nocaptcha\rules;


class SessionTimeTrapRule extends BaseRule
{

    public $name = 'time_trap';

    public $time = 3;

    /**
     * @inheritDoc
     */
    public function render()
    {
        $_SESSION[$this->name] = new \DateTime();
        return "";
    }

    /**
     * @inheritDoc
     */
    public function checkSubmit()
    {

        if ($this->getSubmittedData()){

            /** @var \DateTime $startTime */
            $startTime = $_SESSION[$this->name];
            $currentTime = new \DateTime();
            $interval = $startTime->diff($currentTime);

            if ($interval->s <= $this->time){
                return false;
            }
        }
        return true;
    }
}