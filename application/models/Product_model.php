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
     * @var string
     */
    public $content;

    /**
     * View this items product link on the www.
     *
     * @return string
     */
    public function viewProductLink()
    {
        return base_url("product/view/{$this->produceCode}");
    }

    /**
     * Edit this items product link on the www.
     *
     * @return string
     */
    public function editProductLink()
    {
        return base_url("product/edit/{$this->produceCode}");
    }

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
    public function formatSalePrice()
    {
        return number_format($this->bulkSalePrice, 2);
    }

    /**
     * Get the price with two decimal places.
     *
     * @return string
     */
    public function formatBuyPrice()
    {
        return number_format($this->bulkBuyPrice, 2);
    }

    /**
     * @return array
     */
    public function allProducts()
    {
        return $this->db->get('products')->result('product_model');
    }

    /**
     * @return array
     */
    public function allProductLines()
    {
        return $this->db->select('productLine')->group_by('productLine')->get('products')->result('product_model');
    }

    /**
     * @return array
     */
    public function allSuppliers()
    {
        return $this->db->select('supplier')->group_by('supplier')->get('products')->result('product_model');
    }

    /**
     * @return array
     */
    public function firstWhereProduceCode($produceCode)
    {
        return $this->db->get_where('products', ['produceCode' => $produceCode])->first_row('product_model');
    }

    /**
     * @return array
     */
    public function allWhereLike($text)
    {
        return $this->db->like('description', $text)->get('products')->result('product_model');
    }

    /**
     * @param int $count
     * @return array
     */
    public function getRandomProducts($count = 7)
    {
        return $this->db->order_by('rand()')->limit($count)->get('products')->result('product_model');
    }

    /**
     * @param array $array_keys
     * @return array
     */
    public function allWhereIn(array $array_keys)
    {
        return $this->db->where_in('produceCode', $array_keys)->get('products')->result('product_model');
    }

    /**
     * Check is the product wishlisted by a customer.
     *
     * @param Customer_model $customer
     * @return bool
     */
    public function isWishListedBy($customer)
    {
        $condition = array('product_id' => $this->produceCode, 'customer_id' => $customer->customerNumber);

        $wishlist = $this->db->where($condition)->get('wishlist', 1)->first_row('wishlist_model');

        return $wishlist !== null;
    }

    /**
     * Update the active record to the database.
     *
     * @return bool
     */
    public function update()
    {
        return $this->db->update('products', $this, ['produceCode' => $this->produceCode], 1);
    }
}