<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StoreTest extends PHPUnit_Framework_TestCase
    {

        function testGetStoreName()
        {
            $test_store = new Store("Payless");
            $result = $test_store->getStoreName();
            $this->assertEquals("Payless", $result);
        }

    }
