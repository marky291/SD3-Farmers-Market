<?php

/**
 * Class Product
 *
 * @property Product_model $product_model
 * @property Supplier_model $supplier_model
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
            'product' => $product,
        ]);
    }

    /**
     * Edit a specific product form
     *
     * @param $produceCode
     * @return object|string
     */
    public function edit($produceCode)
    {
        /** @var Product_model $product */
        $product = $this->product_model->firstWhereProduceCode($produceCode);

        // block if not admin
        if (!user()->hasAdminRole()) {
            show_error('You do not have permissions to view this page', 500);
        }

        return $this->load->view('products/view', [
            'editing' => true,
            'heading' => "Editing {$product->description}",
            'product' => $product,
            'suppliers' => $this->supplier_model->all(),
        ]);
    }

    public function update($produceCode)
    {
        if ($produceCode === null) {
            show_error('No produce code provided', 500);
        }

        /** @var Product_model $product */
        $product = $this->product_model->firstWhereProduceCode($produceCode);

        if ($product === null) {
            show_error('Unable to locate product with the produceCode' . $produceCode);
        }

        // check if get request or if the form validation fails.
        if ($this->isGetMethod() || $this->failsFormValidation()) {
            $this->edit($produceCode);
        }

        // make sure admin role gives permission.
        if (!user()->hasAdminRole()) {
            show_error('You do not have permissions to view this page', 500);
        }

        /** @var Supplier_model $supplier */
        $supplier = $this->supplier_model->firstWhereId($this->input->post('supplier_id'));

        $product->description = $this->input->post('description');
        $product->supplier = $supplier->name;
        $product->content = $this->input->post('content');
        $product->bulkSalePrice = $this->input->post('sale_price');
        $product->update();

        // redirect ot the view product link
        redirect($product->viewProductLink());
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