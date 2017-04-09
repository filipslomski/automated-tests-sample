<?php

class CheckoutPage
{
    private $checkoutProvider;
    private $mintPin;

    public function __construct() {
        $this->checkoutProvider = ".//a[@data-id='mint']";
        $this->mintPin = "(.//input[@name='code[]'])[1]";
    }
}