@checkout
Feature: Checkout
  As a user of application
  I want to be able to checkout successfully

  @coretest
  Scenario:
    Given I am on checkout page
    Then I should see following payment providers:
    | mint | |

  Scenario:
    Given I am on checkout page
    When I select mint provider
    Then I should see epin code input

  Scenario:
    Given I am on checkout page
    When I select mint provider
    And  I enter incorrect e-pin
    Then I should see proper error message