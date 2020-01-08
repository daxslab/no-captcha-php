<?php 
class NoCaptchaAntiSpamTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    private function getRulesWithRandomName($randomName){
        return $noCaptchaAntiSpam = \daxslab\nocaptcha\NoCaptchaAntiSpam::create([
            'rules' => [
                \daxslab\nocaptcha\rules\CssHiddenFieldRule::create(),
                \daxslab\nocaptcha\rules\JavascriptGeneratedHiddenFieldRule::create([
                    'parentSelector' => 'form#contactForm',
                ]),
                \daxslab\nocaptcha\rules\FormTimeTrapRule::create([
                    'time' => 3,
                ]),
                \daxslab\nocaptcha\rules\SessionTimeTrapRule::create([
                    'time' => 3,
                ])
            ],
            'random_names' => $randomName
        ]);
    }

    // tests
    public function testApplyRandomNamesFromList()
    {
        $random_name = 1;

        $noCaptchaAntiSpam = $this->getRulesWithRandomName($random_name);

        $names = [];
        foreach ($noCaptchaAntiSpam->rules as $rule) {
            $names[] = $rule->name;
        }

        $count = count($names);

        $this->assertTrue(count(array_unique($names)) == $count);

        $noCaptchaAntiSpam2 = $this->getRulesWithRandomName($random_name);

        $names2 = [];
        foreach ($noCaptchaAntiSpam2->rules as $rule){
            $names2[] = $rule->name;
        }

        $this->assertEquals($names, $names2);

    }

    public function testApplyRandomNamesFromChecksum()
    {
        $random_name = \daxslab\nocaptcha\rules\BaseRule::RANDOM_MD5;

        $noCaptchaAntiSpam = $this->getRulesWithRandomName($random_name);

        $names = [];
        foreach ($noCaptchaAntiSpam->rules as $rule) {
            $names[] = $rule->name;
        }

        $count = count($names);

        $this->assertTrue(count(array_unique($names)) == $count);

        $noCaptchaAntiSpam2 = $this->getRulesWithRandomName($random_name);

        $names2 = [];
        foreach ($noCaptchaAntiSpam2->rules as $rule){
            $names2[] = $rule->name;
        }

        $this->assertEquals($names, $names2);

    }
}
