<?php

/**
 * Class Product
 *
 * @property Product_model $product_model
 * @property Order_model $order_model
 */
class Product extends MY_Controller
{
    /**
     * View all products in the database,
     *
     * @return object|string
     */
    public function index()
    {
        return $this->load->view('products/index', [
            'heading' => 'All Market Items',
            'products' => $this->product_model->allProducts(),
        ]);
    }

    /**
     * View a specific product in the database.
     *
     * @param $produceCode
     * @return object|string
     */
    public function view($produceCode)
    {
        /** @var Product_model $product */
        $product = $this->product_model->firstWhereProduceCode($produceCode);

        return $this->load->view('products/view', [
            'heading' => $product->description,
            'product' => $product,
        ]);
    }

    /**
     * Search products in the database.
     *
     * @return object|string
     */
    public function search()
    {
        $textToSearch = $this->input->get('query');

        return $this->load->view('products/index', [
            'heading' => "Searching {$textToSearch}",
            'products' => $this->product_model->allWhereLike($textToSearch),
        ]);
    }
}