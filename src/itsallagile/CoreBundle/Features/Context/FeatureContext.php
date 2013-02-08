<?php

namespace itsallagile\CoreBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\Step;
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use itsallagile\CoreBundle\Entity\User;
use Sanpi\Behatch\Context\BehatchContext;

/**
 * Feature context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
        $this->useContext('behatch', new BehatchContext($parameters));
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^I have an account$/
     */
    public function iHaveAnAccount()
    {
        $email = 'init@example.com';
    }

    /**
     * @When /^I log in$/
     */
    public function iLogIn()
    {
        return array(
            new Step\When('I am on "/login"'),
            new Step\When('I fill in "email" with "init@example.com"'),
            new Step\When('I fill in "Password" with "password"'),
            new Step\When('I press "Login"'),
        );
    }

    /**
     * @Given /^I am an authenticated user$/
     */
    public function iAmAnAuthenticatedUser()
    {
        return array(
            new Step\When('I am on "/login"'),
            new Step\When('I fill in "email" with "init@example.com"'),
            new Step\When('I fill in "Password" with "password"'),
            new Step\When('I press "Login"'),
        );
    }

    /**
     * @When /^I add a new board called "([^"]*)"$/
     */
    public function iAddANewBoardCalled($boardName)
    {
        return array(
            new Step\When('I am on "/boards/add"'),
            new Step\When('I fill in "Name" with "' . $boardName . '"'),
            new Step\When('I fill in "Slug" with "' . strtolower(str_replace(' ', '', $boardName)) . '"'),
            new Step\When('I select "A-Team" from "Team"'),
            new Step\When('I press "Add"'),
        );
    }

    /**
     * @Then /^I should dump the page$/
     */
    public function iShouldDumpThePage()
    {
        print_r($this->getSession()->getPage()->getText());
    }
}
