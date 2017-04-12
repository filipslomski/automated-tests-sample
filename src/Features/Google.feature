@google @coretest
Feature: Google
  As a user of google
  I want to be able to search successfully

  Scenario: Search in google
    Given I am on the google page
    When I search for phrase filip slomski in google
    Then I should see correct google results