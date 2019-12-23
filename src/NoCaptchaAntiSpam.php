<?php

namespace daxslab\nocaptcha;

class NoCaptchaAntiSpam
{

    public $rules = [];

    public static function create($config){

        $noCaptchaAntiSpam = new NoCaptchaAntiSpam();

        foreach ($config as $name => $value) {
            $noCaptchaAntiSpam->$name = $value;
        }

        return $noCaptchaAntiSpam;
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