<?php 

class SessionBassedTimeTrapCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/session_time_trap.php');
        $I->canSeeInTitle('Session based time trap');
        $I->click('Submit');
        $I->canSee('Bot detected');

        $I->amOnPage('/session_time_trap.php');
        $I->wait(5);
        $I->click('Submit');
        $I->canSee('Form submitted correctly');
    }
}
