Feature: Dashboard
  In order see what I can do in the system
  As a user
  I need to have a user dashboard


  Scenario: Dashboard page loads correctly
    Given I am an authenticated user
    When I am on "/dashboard"
    Then I should see "Dashboard"


  Scenario: User can view their teams
    Given I am an authenticated user
    When I am on "/dashboard"
    Then I should see 1 rows in the "#teams" table
    And the columns schema of the "#teams" table should match:
      | columns |
      | Name |
      | Velocity |
      |  |

  Scenario: User can view their boards
    Given I am an authenticated user
    When I am on "/dashboard"
    Then I should see 2 rows in the "#boards" table
    And the columns schema of the "#boards" table should match:
      | columns |
      | Team |
      | Name |
      | Slug |
      | Stories |
      |  |
   	