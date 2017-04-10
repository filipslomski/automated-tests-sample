<?php

namespace myTests\PageObjects;

use myTests\Contexts\BaseContext;
use RemoteWebDriver;
use WebDriverBy;
use WebDriverElement;

class BasePage
{
    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    protected $url;

    protected function __construct($url)
    {
        $this->webDriver = BaseContext::$webDriver;
        $this->url = $url;
    }

    protected function setLocatorParameter($parameters, $locator)
    {
        $pattern = '/{argument}/';
        if (is_array($parameters)) {
            foreach ($parameters as $parameter) {
                $locator = preg_replace($pattern, $parameter, $locator, 1);
            }
        } else {
            $locator = preg_replace($pattern, $parameters, $locator, 1);
        }
        return $locator;
    }

    public function open() {
        $this->webDriver->get($this->url);
    }

    /**
     * @param string $frameSelector
     */
    protected function switchToFrame($frameSelector)
    {
        if ($frameSelector == 'default') {
            $this->webDriver->switchTo()->defaultContent();
            return;
        }

        $frame = $this->frameWithSelector($frameSelector);
        $this->webDriver->switchTo()->frame($frame);
    }

    /**
     * @param frameSelector
     *
     * @return WebDriverElement
     */
    protected function frameWithSelector($frameSelector)
    {
        $frameFullSelector = "//iframe[contains(@class,'$frameSelector')]
                            | //iframe[@id='$frameSelector']
                            | //iframe[@name='$frameSelector']";
        return $this->webDriver->findElement(WebDriverBy::xpath($frameFullSelector));
    }
}