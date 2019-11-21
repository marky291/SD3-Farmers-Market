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
        return $this->load->view('products/index', [
            'lineProducts' => $this->product_model->allGroupedByProductLine(),
            'lines' => $this->product_model->allProductLines(),
            'suppliers' => $this->product_model->allSuppliers()
        ]);
    }
}