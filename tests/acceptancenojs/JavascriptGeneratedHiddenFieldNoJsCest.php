<?php 

class JavascriptGeneratedHiddenFieldNoJsCest
{
    public function _before(AcceptancenojsTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptancenojsTester $I)
    {
        $I->amOnPage('/javascript_generated_hidden_field_honeypot.php');
        $I->canSeeInTitle('Javascript generated field honeypot');
        $I->click('Submit');
        $I->canSee('Bot detected');
    }
}
