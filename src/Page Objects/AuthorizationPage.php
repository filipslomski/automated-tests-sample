<?php

class AuthorizationPage
{
    private $skipButton;

    public function __construct() {
        $this->skipButton = ".//a[contains(@class,'js-skip')]";
    }
}