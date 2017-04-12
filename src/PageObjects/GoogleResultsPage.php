<?php

namespace myTests\PageObjects;

class GoogleResultsPage extends BasePage
{
    private $numberOfResults;

    public function __construct($searchParam = "") {
        $this->numberOfResults = ".//div[@id='resultStats']";
        $url = "https://www.google.com/?q=" . $searchParam;
        parent::__construct($url);
    }

    public function isNumberOfResultsGreaterThan($expectedNumberOfResults)
    {
        $rawNumberOfResults = $this->webDriver->findElement(\WebDriverBy::xpath($this->numberOfResults))->getText();
        preg_match('/[0-9]+/', str_replace(" ", "", $rawNumberOfResults), $results);
        $actualNumberOfResults = intval($results[0]);

        return $actualNumberOfResults > $expectedNumberOfResults;
    }
}