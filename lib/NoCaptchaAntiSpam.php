<?php

namespace daxslab\nocaptcha;

use daxslab\nocaptcha\rules\BaseRule;

class NoCaptchaAntiSpam
{

    public $rules = [];

    public $random_names = null;

    public static function create($config){

        $noCaptchaAntiSpam = new NoCaptchaAntiSpam();

        foreach ($config as $name => $value) {
            $noCaptchaAntiSpam->$name = $value;
        }

        if ($noCaptchaAntiSpam->random_names){
            $noCaptchaAntiSpam->applyRandomNames();
        }

        return $noCaptchaAntiSpam;
    }

    private function ruleHasName($name){
//        $has_name = false;
        $has_name = array_filter($this->rules, function ($rule) use ($name) {
           return ($rule->name == $name);
        });

        return $has_name;
    }

    public function applyRandomNames(){
        $assigned_names = [];
        foreach ($this->rules as $rule) {
            /** @var BaseRule $rule */
            if (!$rule->random_name) {
                $nameInSession = $rule->getNameInSession();
                if ($nameInSession){
                    $rule->name = $nameInSession;
                } else {
                    $rule->random_name = $this->random_names;
                    $rule->name = BaseRule::getRandomName($rule->random_name);
                }
            }
            while (in_array($rule->name, $assigned_names)){
                $rule->name = BaseRule::getRandomName($rule->random_name);
            }
            $rule->setNameInSession();
            $assigned_names[] = $rule->name;
        }
    }

    public function renderRules(){

        $fields = '';

        foreach ($this->rules as $rule) {
            $fields .= $rule->render();
        }

        return $fields;
    }

    public function checkSubmit(){

        foreach ($this->rules as $rule) {
            if (!$rule->checkSubmit()){
                return false;
            }
        }

        return true;
    }

}