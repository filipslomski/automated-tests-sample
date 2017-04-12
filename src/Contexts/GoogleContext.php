<?php

namespace myTests\Contexts;

use Behat\Behat\Context\Context;
use myTests\PageObjects\GooglePage;
use myTests\PageObjects\GoogleResultsPage;
use myTests\Utilities\ActionRepeater;
use myTests\Utilities\BaseConsts;
use PHPUnit\Framework\Assert;

class GoogleContext implements Context
{
    use ActionRepeater;

    private $googlePage;
    private $googleResultsPage;

    public function __construct()
    {
        $this->googlePage = new GooglePage();
        $this->googleResultsPage = new GoogleResultsPage();
    }

    /**
     * @Given /^I am on the google page$/
     */
    public function iAmOnTheGooglePage()
    {
        $this->googlePage->open();
    }

    /**
     * @When /^I search for phrase (.*) in google$/
     */
    public function iSearchForPhraseFilipSlomskiInGoogle($searchPhrase)
    {
        $this->googlePage->fillSearchField($searchPhrase);
    }

    /**
     * @Given /^I select phrase (.*) from suggestion listbox$/
     */
    public function iSelectPhraseFilipSlomskiPhotographyFromSuggestionListbox($suggestionPhrase)
    {
        $this->repeatAction(function() use ($suggestionPhrase) {
            $this->googlePage->selectSearchSuggestion($suggestionPhrase);
            return true;
        }, BaseConsts::TIMEOUT_SHORT);
    }

    /**
     * @Then /^I should see over (\d+) results$/
     */
    public function iShouldSeeMoreThanXGoogleResults($expectedNumberOfResults)
    {
        $this->repeatAction(function() use ($expectedNumberOfResults) {
            Assert::assertTrue($this->googleResultsPage->isNumberOfResultsGreaterThan(intval($expectedNumberOfResults)));
            return true;
        }, BaseConsts::TIMEOUT_SHORT);
    }
}