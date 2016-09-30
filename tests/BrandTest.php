<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Brand.php";
    require_once "src/Store.php";
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function testGetBrandName()
        {
            $test_brand = new Brand("Nike");
            $result = $test_brand->getBrandName();
            $this->assertEquals("Nike", $result);
        }

        function testSave()
        {
            $test_brand = new Brand("Nike");
            $test_brand->save();
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }


        function testFind()
        {
            $test_brand = new Brand("Nike");
            $test_brand->save();
            $result = Brand::find($test_brand->getId());
            $this->assertEquals($test_brand, $result);
        }

        function testAddStore()
        {
            $test_store = new Store("Payless");
            $test_store->save();
            $test_brand = new Brand("Nike");
            $test_brand->save();
            $test_brand->addStore($test_store->getId());
            $result = $test_brand->getStores();
            $this->assertEquals([$test_store], $result);
        }

        function testGetOtherStores()
        {
            $test_brand = new Brand("Nike");
            $test_brand->save();
            $test_store = new Store("Payless");
            $test_store->save();
            $test_store2 = new Store("Famous Footwear");
            $test_store2->save();
            $test_brand->addStore($test_store->getId());
            $result = $test_brand->getOtherStores();
            $this->assertEquals([$test_store2], $result);
        }

    }
