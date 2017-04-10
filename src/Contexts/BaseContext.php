<?php

namespace myTests\Contexts;

use Behat\Behat\Context\Context;
use RemoteWebDriver;

class BaseContext implements Context
{
    /**
     * @var RemoteWebDriver
     */
    public static $webDriver;

    /** @BeforeSuite */
    public static function initWebDriver(){
        $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
        self::$webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    /** @AfterSuite */
    public static function tearDownWebDriver(){
        self::$webDriver->close();
    }
}