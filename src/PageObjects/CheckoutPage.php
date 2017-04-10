<?php

namespace myTests\PageObjects;

class CheckoutPage extends BasePage
{
    private $checkoutProvider;
    private $mintPinField;
    private $mintCode;
    private $accountName;
    private $errorMessageWithText;
    private $mintBuyButton;

    public function __construct($mint = false) {
        $this->checkoutProvider = ".//a[@data-id='{argument}']";
        $this->mintPinField = "(.//input[@name='code[]'])[{argument}]";
        $this->mintCode = "code";
        $this->mintBuyButton = "but"; //interesting id
        $this->errorMessageWithText = ".//*[@id='error_msg' and contains(text(),'{argument}')]";
        $this->accountName = ".//span[contains(@class,'account__name') and text()='{argument}']";
        $checkoutUrl = "https://api.paymentwall.com/api/subscription/?key=7e5493348058db49c82dbcfe70f14716&uid=218069344334&widget=fp&amount=5&currencyCode=USD&ag_name=Test+Product&ag_type=fixed&ag_external_id=1&vc=goods&country_code=VN&sign_version=2&sign=fe5e0f1e79605ea50e7f9495746790ab";
        $mintUrl = "https://api.paymentwall.com/api/subscription/?key=7e5493348058db49c82dbcfe70f14716&uid=218069344334&widget=fp&amount=5&currencyCode=USD&ag_name=Test+Product&ag_type=fixed&ag_external_id=1&vc=goods&ps=mint&country_code=VN&sign_version=2&sign=f957b999620d9643dfecd4abf34a6c44";
        $url =  $mint ? $mintUrl : $checkoutUrl;
        parent::__construct($url);
    }

    /**
     * @param $expectedUserName
     * @return bool
     */
    public function verifyLoggedUser($expectedUserName)
    {
        sleep(10); //active wait should be used here instead - ActionRepeater trait
        $accountNameLocator = $this->setLocatorParameter($expectedUserName, $this->accountName);
        return $this->webDriver->findElement(\WebDriverBy::xpath($accountNameLocator))->isDisplayed();
    }

    /**
     * @param $providerName
     * @return bool
     */
    public function isProviderVisible($providerName)
    {
        $providerNameLocator = $this->setLocatorParameter($providerName, $this->checkoutProvider);
        return $this->webDriver->findElement(\WebDriverBy::xpath($providerNameLocator))->isDisplayed();
    }

    /**
     * @param $providerName
     */
    public function selectProvider($providerName)
    {
        sleep(2); //active wait should be used here instead - ActionRepeater trait
        $providerNameLocator = $this->setLocatorParameter($providerName, $this->checkoutProvider);
        $this->webDriver->findElement(\WebDriverBy::xpath($providerNameLocator))->click();
    }

    /**
     * @return bool
     */
    public function isMintCodeFieldsVisible()
    {
        return $this->webDriver->findElement(\WebDriverBy::id($this->mintCode))->isDisplayed();
    }

    /**
     * @param $mintEpin
     */
    public function enterMintEpin($mintEpin)
    {
        sleep(1); //active wait should be used here instead - ActionRepeater trait
        $epinField = 1;
        foreach(explode(" ", $mintEpin) as $epinPart) {
            $mintPinFieldLocator = $this->setLocatorParameter($epinField++, $this->mintPinField);
            $this->webDriver->findElement(\WebDriverBy::xpath($mintPinFieldLocator))->sendKeys($epinPart);
        }
    }

    /**
     * @return void
     */
    public function clickMintBuyButton()
    {
        $this->webDriver->findElement(\WebDriverBy::id($this->mintBuyButton))->click();
    }

    /**
     * @param $errorMessageText
     * @return bool
     */
    public function isMintCodeErrorMsgWithTextVisible($errorMessageText)
    {
        sleep(3); //active wait should be used here instead - ActionRepeater trait
        $errorMessageLocator = $this->setLocatorParameter($errorMessageText, $this->errorMessageWithText);
        return $this->webDriver->findElement(\WebDriverBy::xpath($errorMessageLocator))->isDisplayed();
    }
}