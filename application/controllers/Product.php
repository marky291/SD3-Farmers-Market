<?php

/**
 * Class Product
 *
 * @property Product_model $product_model
 */
class Product extends MY_Controller
{
    public function index()
    {
        $productLine = $this->product_model->allGroupedByProductLine();

        return $this->load->view('products/index', compact('productLine'));
    }
}