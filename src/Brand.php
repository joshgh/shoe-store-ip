<?php
    class Brand
    {
        private $id;
        private $brand_name;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getBrandName()
        {
            return $this->brand_name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->brand_name}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands");
            $brand_array = array();
            foreach ($returned_brands as $brand){
                $id = $brand['id'];
                $brand_name = $brand['brand_name'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brand_array, $new_brand);
            }
            return $brand_array;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function find($search_id)
        {
            $returned_brand = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$search_id}");
            $brand = null;
            $brand_array = $returned_brand->fetch(PDO::FETCH_ASSOC);
            if ($brand_array){
                $brand = new Brand($brand_array['brand_name'], $brand_array['id']);
            }
            return $brand;
        }
    }
?>
