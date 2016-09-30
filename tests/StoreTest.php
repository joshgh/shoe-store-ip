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

        function testSave()
        {
            $test_store = new Store("Payless");
            $test_store->save();
            $result = Store::getAll();
            $this->assertEquals($test_store, $result[0]);
        }

        function testDelete()
        {
            $test_store = new Store("Payless");
            $test_store->save();
            $test_store->delete();
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

    }
