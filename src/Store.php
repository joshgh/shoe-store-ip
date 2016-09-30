<?php
    class Store
    {
        private $id;
        private $store_name;

        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getStoreName()
        {
            return $this->store_name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->store_name}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->id};");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_name}' WHERE id = {$this->id};");
            $this->store_name = $new_name;
        }

        function addBrand($brand_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand_id}, {$this->id});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM brands_stores JOIN brands ON (brands_stores.brand_id = brands.id) WHERE brands_stores.store_id = {$this->id};");
            $brand_array = array();
            foreach ($returned_brands as $brand){
                $id = $brand['id'];
                $brand_name = $brand['brand_name'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brand_array, $new_brand);
            }
            return $brand_array;
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores");
            $store_array = array();
            foreach ($returned_stores as $store){
                $id = $store['id'];
                $store_name = $store['store_name'];
                $new_store = new Store($store_name, $id);
                array_push($store_array, $new_store);
            }
            return $store_array;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function find($search_id)
        {
            $returned_store = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id}");
            $store = null;
            $store_array = $returned_store->fetch(PDO::FETCH_ASSOC);
            if ($store_array){
                $store = new Store($store_array['store_name'], $store_array['id']);
            }
            return $store;
        }

    }

?>
