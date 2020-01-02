<?php

/**
 * Class Product
 *
 * @property Product_model $product_model
 * @property CI_Session $session
 */
class Basket extends MY_Controller
{
    /**
     * Display all the items in the basket.
     */
    public function index()
    {
        $basket = $this->session->userdata('basket');

        return $this->load->view('basket/index', [
            'heading' => 'My Shopping Basket Item',
            'products' => $this->product_model->allWhereIn(array_keys($basket)),
        ]);
    }

    /**
     * Store a new item in the basket
     *
     * @param $produce_code
     */
    public function store($produce_code)
    {
        // get the product from the database.
        /** @var Product_model $product */
        $product = $this->product_model->firstWhereProduceCode($produce_code);

        // if product dosnt exist, dont add it.
        if ($product === null) {
            show_error("No product found with id {$produce_code}", 500);
        }

        // dismantle previous baskets
        if ($this->session->has_userdata('basket')) {
            $basket = $this->session->userdata('basket');
        } else {
            $basket = array();
        }

        // initialize the key in the array.
        if (!array_key_exists($produce_code, $basket)) {
            $basket = array_merge($basket, array($produce_code => 0));
        }

        // add our new item to that basket.
        $basket[$produce_code]++;

        // then recreate the basket into the session.
        $this->session->set_userdata('basket', $basket);
    }

    /**
     * Remove the item in the basket.
     *
     * @param $produceCode
     */
    public function delete($produceCode)
    {
        $basket = $this->session->userdata('basket');

        if (array_key_exists($produceCode, $basket)) {
            $basket[$produceCode]--;
        }
    }
}