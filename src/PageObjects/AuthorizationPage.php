<?php

namespace myTests\PageObjects;


class AuthorizationPage extends BasePage
{
    private $skipButton;
    private $loginLink;
    private $authorizationIFrame;
    private $loginEmailField;
    private $loginPasswordField;
    private $loginButton;

    public function __construct() {
        $this->skipButton = ".//a[contains(@class,'js-skip')]";
        $this->loginLink = ".//a[text()='Log In']";
        $this->loginIFrame = "login-iframe";
        $this->loginEmailField = "email";
        $this->loginPasswordField = "signin_password";
        $this->loginButton = ".//button[@type='submit']";
        $url = "https://api.paymentwall.com/api/subscription/?key=7e5493348058db49c82dbcfe70f14716&uid=218069344334&widget=fp&amount=5&currencyCode=USD&ag_name=Test+Product&ag_type=fixed&ag_external_id=1&vc=goods&country_code=VN&sign_version=2&sign=fe5e0f1e79605ea50e7f9495746790ab";
        parent::__construct($url);
    }

    public function skipRegistrationIfVisible()
    {
        sleep(3); //active wait should be used here instead - ActionRepeater trait
        $this->switchToFrame($this->authorizationIFrame);
        if ($this->webDriver->findElement(\WebDriverBy::xpath($this->skipButton))->isDisplayed()) {
            $this->webDriver->findElement(\WebDriverBy::xpath($this->skipButton))->click();
        }
        $this->switchToFrame('default');
    }

    public function clickLoginLink()
    {
        $this->webDriver->manage()->timeouts()->implicitlyWait(3); //active wait should be used here instead
        $this->switchToFrame($this->authorizationIFrame);
        $this->webDriver->findElement(\WebDriverBy::xpath($this->loginLink))->click();
        $this->switchToFrame('default');
    }

    public function loginWithCredentials($userName, $userPassword)
    {
        $this->fillUserNameField($userName);
        $this->fillUserNamePassword($userPassword);
        $this->clickLoginButton();
    }

    public function fillUserNameField($userName)
    {
        $this->switchToFrame($this->authorizationIFrame);
        $this->webDriver->findElement(\WebDriverBy::id($this->loginEmailField))->sendKeys($userName);
        $this->switchToFrame('default');
    }

    public function fillUserNamePassword($userPassword)
    {
        $this->switchToFrame($this->authorizationIFrame);
        $this->webDriver->findElement(\WebDriverBy::id($this->loginPasswordField))->sendKeys($userPassword);
        $this->switchToFrame('default');
    }

    public function clickLoginButton()
    {
        sleep(5);
        $this->switchToFrame($this->authorizationIFrame);
        $this->webDriver->findElement(\WebDriverBy::xpath($this->loginButton))->click();
        $this->switchToFrame('default');
    }
}