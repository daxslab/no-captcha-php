<?php 

class JavascriptGeneratedHiddenFieldCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/javascript_generated_hidden_field_honeypot.php');
        $I->canSeeInTitle('Javascript generated field honeypot');
        $I->click('Submit');
        $I->canSee('Form submitted correctly');
    }
}
