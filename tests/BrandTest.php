<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Brand.php";
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
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

    }
