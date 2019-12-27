<?php 

class CookieCheckCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/cookie_check.php');
        $I->click('Submit');
        $I->canSee('Form submitted correctly');

        $I->amOnPage('/cookie_check.php');
        $I->resetCookie('cookie_rule');
        $I->click('Submit');
        $I->canSee('Bot detected');
    }
}
