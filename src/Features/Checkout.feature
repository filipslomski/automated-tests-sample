@checkout @coretest
Feature: Checkout
  As a user of application
  I want to be able to checkout successfully

  Scenario: Check if providers are visible
    Given I am on checkout page
    Then I should see following payment providers:
    | mint | vtctelcocard |

  Scenario: Check if mint epin code input is visible
    Given I am on checkout mint provider page
    Then I should see epin code input

  Scenario: Check if incorrect epin code results in aprropriate error message
    Given I am on checkout mint provider page
    When  I enter incorrect e-pin
    Then I should see proper error message