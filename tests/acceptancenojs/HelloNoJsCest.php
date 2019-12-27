<?php 

class HelloNoJsCest
{
    public function _before(AcceptancenojsTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptancenojsTester $I)
    {
        $I->amOnPage('/');
        $I->see('No Captcha Form Spam Filter');
    }
}
