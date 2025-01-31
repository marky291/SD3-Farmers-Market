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
    public $quantityInStock = 0;
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
     * Delete this item from the www.
     */
    public function deleteProductLink()
    {
        return base_url("product/delete/{$this->produceCode}");
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
        return $this->db->where('deleted_at', null)->get('products')->result('product_model');
    }

    /**
     * @return array
     */
    public function allProductsWithTrashed()
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
        return $this->db->where('deleted_at', null)->get_where('products', ['produceCode' => $produceCode])->first_row('product_model');
    }

    /**
     * @return array
     */
    public function allWhereLike($text)
    {
        return $this->db->where('deleted_at', null)->like('description', $text)->get('products')->result('product_model');
    }

    /**
     * @param int $count
     * @return array
     */
    public function getRandomProducts($count = 7)
    {
        return $this->db->where('deleted_at', null)->order_by('rand()')->limit($count)->get('products')->result('product_model');
    }

    /**
     * @param array $array_keys
     * @return array
     */
    public function allWhereIn(array $array_keys)
    {
        return $this->db->where('deleted_at', null)->where_in('produceCode', $array_keys)->get('products')->result('product_model');
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
     * @return bool
     */
    public function exists()
    {
        return $this->produceCode ? true : false;
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

    /**
     * Save the object as an new entity in the database with the attributes
     *
     * @param array $attributes
     * @return Customer_model
     */
    public function save($attributes = array())
    {
        // insert into database,
        $this->db->insert('products', $attributes);

        // return the object we created in database (ORM)
        return $this->firstWhereProduceCode($attributes['produceCode']);
    }

    /**
     * Soft delete from view, not the database.
     *
     * @return bool
     */
    public function softDelete()
    {
        $this->deleted_at = mdate();

        return $this->update();
    }
}