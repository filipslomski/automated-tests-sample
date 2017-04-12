<?php

namespace myTests\PageObjects;


class GooglePage extends BasePage
{
    private $searchField;
    private $googleSearchButton;
    private $imFeelingLuckyButton;
    private $searchSuggestionWithText;

    public function __construct() {
        $this->searchField = "lst-ib";
        $this->googleSearchButton = ".//input[@value='Google Search']";
        $this->imFeelingLuckyButton = ".//input[@value='I\'m Feeling Lucky']";
        $this->searchSuggestionWithText = ".//ul[@role='listbox']/li//div[string(.)='{argument}']";
        $url = "https://www.google.com";
        parent::__construct($url);
    }

    /**
     * @param $searchPhrase
     */
    public function fillSearchField($searchPhrase)
    {
        $this->webDriver->findElement(\WebDriverBy::id($this->searchField))->sendKeys($searchPhrase);
    }

    /**
     * @param $searchSuggestion
     */
    public function selectSearchSuggestion($searchSuggestion)
    {
        $searchSuggestionLocator = $this->setLocatorParameter($searchSuggestion, $this->searchSuggestionWithText);
        $this->webDriver->findElement(\WebDriverBy::xpath($searchSuggestionLocator))->click();
    }

    public function pressSearchButton()
    {
        $this->webDriver->findElement(\WebDriverBy::xpath($this->googleSearchButton))->click();
    }

    public function pressImFeelingLuckyButton()
    {
        $this->webDriver->findElement(\WebDriverBy::xpath($this->imFeelingLuckyButton))->click();
    }
}