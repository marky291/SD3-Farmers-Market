<?php

/**
 * Class Wishlist
 *
 * @property Wishlist_model $wishlist_model
 * @property Product_model $product_model
 */
class Wishlist extends MY_Controller
{
    /**
     * View wishlist products, reuse the products form <3
     *
     * @return object|string
     */
    public function index()
    {
        $wishlistProducts = $this->wishlist_model
            ->allProductsBelongingToCustomer(user()->customerNumber);

        return $this->load->view('products/index', [
            'heading' => 'My Saved Product',
            'products' => $wishlistProducts,
        ]);
    }

    /**
     * Save a new item to the wishlist.
     */
    public function store()
    {
        if ($this->isGetMethod()) {
            redirect('/');
        }

        // get json array
        $data = $this->getJsonAssociativeArray();

        if (!isset($data['productCode'])) {
            show_error('Product code not passed for storing to wishlist', 500);
        }

        // add the product to the users wishlist.
        return (new Wishlist_model)->save([
            'product_id' => $data['productCode'],
            'customer_id' => user()->customerNumber,
        ]);
    }

    public function destroy()
    {
        if ($this->isGetMethod()) {
            redirect('/');
        }

        // json response
        $data = $this->getJsonAssociativeArray();

        if (!isset($data['productCode'])) {
            show_error('Product code not passed for storing to wishlist', 500);
        }

        // add the product to the users wishlist.
        return (new Wishlist_model)->delete([
            'product_id' => $data['productCode'],
            'customer_id' => user()->customerNumber,
        ]);
    }
}