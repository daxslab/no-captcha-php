<?php 

class JavascriptFilledInputCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/javascript_filled_input.php');
        $I->canSeeInTitle('JavaScript filled input');
        $I->click('Submit');
        $I->canSee('Form submitted correctly');
    }
}
