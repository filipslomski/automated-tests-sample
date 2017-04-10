<?php

namespace myTests\Contexts;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use myTests\PageObjects\AuthorizationPage;
use myTests\PageObjects\CheckoutPage;
use myTests\Utilities\BaseConsts;
use PHPUnit\Framework\Assert;

class LoginContext implements Context
{
    private $authorizationPage;
    private $checkoutPage;

    public function __construct()
    {
        $this->authorizationPage = new AuthorizationPage();
        $this->checkoutPage = new CheckoutPage();
    }

    /**
     * @Given /^I am on the register page$/
     */
    public function iAmOnTheRegisterPage()
    {
        $this->authorizationPage->open();
    }

    /**
     * @When /^I move to login page$/
     */
    public function iMoveToLoginPage()
    {
        $this->authorizationPage->clickLoginLink();
    }

    /**
     * @Given /^I login as an existing user$/
     */
    public function iLoginAsAnExistingUser()
    {
        $this->authorizationPage->loginWithCredentials(
            BaseConsts::EXAMPLE_EXISTING_USERNAME,
            BaseConsts::EXAMPLE_EXISTING_PASSWORD
        );
    }

    /**
     * @Then /^I should be successfully logged in$/
     */
    public function iShouldBeSuccessfullyLoggedIn()
    {
        Assert::assertTrue($this->checkoutPage->verifyLoggedUser(BaseConsts::EXAMPLE_EXISTING_USERDATA));
    }
}
