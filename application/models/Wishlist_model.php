<?php

/**
 * Class Product_model
 *
 * @property CI_DB_query_builder $db
 */
class Wishlist_model extends MY_Model
{
    /**
     * Get all the wishlist items that belongs to the customer id key.
     *
     * @param $number
     * @return array
     */
    public function allProductsBelongingToCustomer($number)
    {
        return $this->db
            ->select('products.*')
            ->from('wishlist')
            ->join('products', 'products.produceCode = wishlist.product_id')
            ->where('products.deleted_at', null)
            ->get()
            ->result('product_model');
    }

    /**
     * Get all the wishlist items that belongs to the customer id key.
     *
     * @param $code
     * @return array
     */
    public function allCustomersBelongingToProduct($code)
    {
        return $this->db
            ->select('customers.*')
            ->from('wishlist')
            ->join('products', 'products.produceCode = wishlist.customer_id')
            ->where('products.deleted_at', null)
            ->get()
            ->result('customer_model');
    }

    /**
     * Save model to the database.
     *
     * @param array $attributes
     * @return bool
     */
    public function save($attributes = array())
    {
        return $this->db->insert('wishlist', $attributes);
    }

    /**
     * Remove model from the database.
     *
     * @param array $attributes
     * @return mixed
     */
    public function delete($attributes = array())
    {
        return $this->db->delete('wishlist', $attributes, 1);
    }
}