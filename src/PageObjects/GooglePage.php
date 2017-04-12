<?php

namespace myTests\PageObjects;


class GooglePage extends BasePage
{
    private $searchField;
    private $googleSearchButton;
    private $imFeelingLuckyButton;

    public function __construct() {
        $this->searchField = "lst-ib";
        $this->googleSearchButton = ".//input[@value='Google Search']";
        $this->imFeelingLuckyButton = ".//input[@value='I\'m Feeling Lucky']";
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

    public function pressSearchButton()
    {
        $this->webDriver->findElement(\WebDriverBy::xpath($this->googleSearchButton))->click();
    }

    public function pressImFeelingLuckyButton()
    {
        $this->webDriver->findElement(\WebDriverBy::xpath($this->imFeelingLuckyButton))->click();
    }
}