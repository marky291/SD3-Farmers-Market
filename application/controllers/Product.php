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
        if (! authenticated() || ! user()->hasAdminRole()) {
            show_error('You do not have permissions to view this page', 500);
        }

        return $this->load->view('products/view', [
            'editing' => true,
            'product' => $product,
            'suppliers' => $this->supplier_model->all(),
            'heading' => "Editing {$product->description}",
        ]);
    }

    /**
     * Form for creating, with a empty object.
     *
     * @return object|string
     */
    public function create()
    {
        // block if not admin
        if (! authenticated() || ! user()->hasAdminRole()) {
            show_error('You do not have permissions to view this page', 500);
        }

        return $this->load->view('products/view', [
            'editing' => true,
            'product' => new Product_model,
            'heading' => 'Creating a new product',
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

        // redirect to view.
        return $this->view($produceCode);
    }

    public function save()
    {
        // check if get request or if the form validation fails.
        if ($this->isGetMethod() || $this->failsFormValidation()) {
            $this->create();
        }

        // try upload main image.
        if (!$this->upload->do_upload()) {
            throw new Exception($this->upload->display_errors()[0]);
        }

        // image resizer and shit
        $filename = $this->upload->data()['file_name'];
        $fullPath = $this->upload->data()['full_path'];
        $this->createProductFullImage($fullPath);
        $this->createProductThumbnail($fullPath);

        // create model.
        $product = new Product_model();

        // get the supplier
        $supplier_id = $this->input->post('supplier_id');
        $supplier = (new Supplier_model)->firstWhereId($supplier_id);

        $product->save(array(
            'produceCode' => 'S'.rand(10, 99).'_'.rand(1000, 9999),
            'description' => $this->input->post('description'), //title
            'content' => $this->input->post('content'),
            'productLine' => $this->input->post('productLine'),
            'supplier' => $supplier->name,
            'quantityInStock' => $this->input->post('stock'),
            'bulkBuyPrice' => $this->input->post('sale_price'),
            'photo' => $filename,
        ));
    }

    private function createProductFullImage($path) 
    {
        $config['source_image'] = $path;
        $config['maintain_ratio'] = 'TRUE';
        $config['width'] = '350';
        $config['height'] = '200';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    private function createProductThumbnail($path) 
    {
		$config['source_image'] = $path;
		$config['new_image'] = '../public/images/products/thumbs/';
		$config['maintain_ratio'] = 'FALSE';
		$config['width'] = '145';
		$config['height'] = '78';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
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

    /**
     * Soft delete a product
     */
    public function delete($produceCode)
    {
        /** @var Product_model $product */
        $product = $this->product_model->firstWhereProduceCode($produceCode);

        // delete the model.
        $product->softDelete();

        // return to index.
        return $this->index();
    }
}