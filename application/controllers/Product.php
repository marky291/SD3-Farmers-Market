<?php

/**
 * Class Product
 *
 * @property Product_model $product_model
 * @property Order_model $order_model
 */
class Product extends MY_Controller
{
    public function index()
    {
        return $this->load->view('products/index', [
            'heading' => 'All Market Items',
            'products' => $this->product_model->allProducts(),
        ]);
    }

    public function view($produceCode)
    {
        $product = $this->product_model->firstWhereProduceCode($produceCode);

        return $this->load->view('products/view', [
            'heading' => $product->description,
            'product' => $product,
        ]);
    }

    public function search()
    {
        $textToSearch = $this->input->get('query');

        return $this->load->view('products/index', [
            'heading' => "Searching {$textToSearch}",
            'products' => $this->product_model->allWhereLike($textToSearch),
        ]);
    }
}