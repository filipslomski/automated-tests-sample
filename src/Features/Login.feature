@login @coretest
Feature: Login
  As a user of application
  I want to log in successfully

  Scenario: Login to the site with an existing user
    Given I am on the register page
    When I move to login page
    And I login as an existing user
    Then I should be successfully logged in