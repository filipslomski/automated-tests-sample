<?php

namespace myTests\Contexts;

use myTests\PageObjects\GooglePage;

class GoogleContext
{
    private $googlePage;

    public function __construct()
    {
        $this->googlePage = new GooglePage();
    }

    /**
     * @Given /^I am on the google page$/
     */
    public function iAmOnTheGooglePage()
    {
        $this->googlePage->open();
    }

}