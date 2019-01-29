<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/classes/DB.php';
require_once __DIR__ . '/../../src/classes/User.php';

class UserTest extends \Codeception\Test\Unit
{

    /**
     * @var \UnitTester
     */
    protected $tester;

    private $testUser;
    
    protected function _before()
    {
        $this->setup();
    }

    protected function _after()
    {
    }

    protected function setup(){
        $db = DB::getDBConnection();
        $this->testUser = new User($db);
    }

    /**
     * Testing for creating new user
     */
    public function testCreateUser(){
        /**
         * Create database connection
         */

        $result = $this->testUser->addUser("Bob Kåre","bobkåre@gmail.com","Password99","99887744", "Starlord");
        self::assertTrue($result);

        }

    /**
     * Test for login function
     */
    public function testlogin(){
        $db = DB::getDBConnection();
        $this->testUser = new User($db);

        $email = "bobkåre@gmail.com";
        $passwordCorrect = "Password99";

        $status = $this->testUser->login($email, $passwordCorrect);

        self::assertEquals('ok', $status);

        $passwordFalse = "Password69";

        $status = $this->testUser->login($email, $passwordFalse);

        self::assertNotEquals('ok', $status);

    }

    public function testDeleteUser(){
        $status = $this->testUser->deleteUser();
        self::assertEquals('ok', $status);
    }

}