<?php 

class CssHiddenFieldNoJsCest
{
    public function _before(AcceptancenojsTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptancenojsTester $I)
    {
        $I->amOnPage('/css_hidden_field_honeypot.php');
        $I->canSeeInTitle('Basic hidden field honeypot');
        $I->canSeeElement('input[name=css_hidden_field]');
        $I->click('Submit');
        $I->canSee('Form submitted correctly');
        $I->checkOption('input[name=css_hidden_field]');
        $I->click('Submit');
        $I->canSee('Bot detected');
    }
}
