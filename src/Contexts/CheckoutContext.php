<?php

namespace myTests\Contexts;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use myTests\PageObjects\AuthorizationPage;
use myTests\PageObjects\CheckoutPage;
use myTests\Utilities\BaseConsts;
use PHPUnit\Framework\Assert;

class CheckoutContext implements Context
{
    private $authorizationPage;
    private $checkoutPage;
    private $checkoutMintPage;

    public function __construct()
    {
        $this->authorizationPage = new AuthorizationPage();
        $this->checkoutPage = new CheckoutPage();
        $this->checkoutMintPage = new CheckoutPage(true);
    }

    /**
     * @Given /^I am on checkout page$/
     */
    public function iAmOnCheckoutPage()
    {
        $this->checkoutPage->open();
    }

    /**
     * @Then /^I should see following payment providers:$/
     */
    public function iShouldSeeFollowingPaymentProviders(TableNode $providers)
    {
        foreach ($providers->getHash() as $provider) {
            Assert::assertTrue($this->checkoutPage->isProviderVisible($provider));
        }
    }

    /**
     * @When /^I select (.*) provider$/
     */
    public function iSelectMintProvider($providerName)
    {
        $this->checkoutPage->selectProvider($providerName);
    }

    /**
     * @Then /^I should see epin code input$/
     */
    public function iShouldSeeEpinCodeInput()
    {
        Assert::assertTrue($this->checkoutPage->isMintCodeFieldsVisible());
    }

    /**
     * @Given /^I enter incorrect e\-pin$/
     */
    public function iEnterIncorrectEPin()
    {
        $this->checkoutPage->enterMintEpin(BaseConsts::EXAMPLE_INCORRECT_MINT_EPIN);
        $this->checkoutPage->clickMintBuyButton();
    }

    /**
     * @Then /^I should see proper error message$/
     */
    public function iShouldSeeProperErrorMessage()
    {
        Assert::assertTrue($this->checkoutPage->isMintCodeErrorMsgWithTextVisible(BaseConsts::MINT_ERROR_MESSAGE_FOR_INCORRECT_PIN));
    }

    /**
     * @Given /^I am on checkout mint provider page$/
     */
    public function iAmOnCheckoutMintProviderPage()
    {
        $this->checkoutMintPage->open();
        $this->authorizationPage->skipRegistrationIfVisible();
    }
}