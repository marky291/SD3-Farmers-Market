<?php

/**
 * Class Product_model
 *
 * @property CI_DB_query_builder $db
 */
class Product_model extends MY_Model
{
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $productLine;
    /**
     * @var int
     */
    public $quantityInStock;
    /**
     * @var double
     */
    public $bulkBuyPrice;
    /**
     * @var double
     */
    public $bulkSalePrice;
    /**
     * @var string
     */
    public $photo;
    /**
     * @var string
     */
    public $produceCode;
    /**
     * @var string
     */
    public $supplier;

    /**
     * Get the full image url for items image O.O
     *
     * @return string
     */
    public function fullImageUrl()
    {
        return base_url("images/products/full/{$this->photo}");
    }

    /**
     * Get the full image url for items image O.O
     *
     * @return string
     */
    public function thumbImageUrl()
    {
        return base_url("images/products/thumbs/{$this->photo}");
    }

    /**
     * Get the price with two decimal places.
     *
     * @return string
     */
    public function formatPrice()
    {
        return number_format($this->bulkSalePrice, 2);
    }

    public function allProducts()
    {
        return $this->db->get('products')->result('product_model');
    }

    public function allProductLines()
    {
        return $this->db->select('productLine')->group_by('productLine')->get('products')->result('product_model');
    }

    public function allSuppliers()
    {
        return $this->db->select('supplier')->group_by('supplier')->get('products')->result('product_model');
    }

    /**
     * Get all the items grouped by the product line,
     *
     * @return array
     */
    public function allGroupedByProductLine()
    {
        $grouped = array();

        // store as group in array
        foreach ($this->allProducts() as $product) {
            $grouped[$product->productLine][] = $product;
        }

        return $grouped;
    }
}