<?php

/**
 * Class Product_model
 *
 * @property CI_DB_query_builder $db
 */
class Product_model extends MY_Model
{
    public $description;
    public $productLine;
    public $quantityInStock;
    public $bulkBuyPrice;
    public $bulkSalePrice;
    public $photo;
    public $produceCode;
    public $supplier;

    public function fullImageUrl()
    {
        return base_url("images/products/full/{$this->photo}");
    }

    public function all()
    {
        return $this->db->get('products')->result('Product_model');
    }

    public function allGroupedByProductLine()
    {
        $grouped = array();

        // store as group in array
        foreach ($this->all() as $product) {
            $grouped[$product->productLine][] = $product;
        }

        return $grouped;
    }
}