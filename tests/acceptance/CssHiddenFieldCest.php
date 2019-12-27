<?php 

class CssHiddenFieldCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/css_hidden_field_honeypot.php');
        $I->canSeeInTitle('Basic hidden field honeypot');
        $I->cantSeeElement('input[name=css_hidden_field]');
        $I->click('Submit');
        $I->canSee('Form submitted correctly');
    }
}
