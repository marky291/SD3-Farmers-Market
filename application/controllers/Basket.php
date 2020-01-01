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

    }

    /**
     * Store a new item in the basket
     *
     * @param $produce_code
     */
    public function store($produce_code)
    {
        //$this->session->unset_userdata('basket');

        // get the product from the database.
        /** @var Product_model $product */
        $product = $this->product_model->firstWhereProduceCode($produce_code);

        // if product dosnt exist, dont add it.
        if ($product === null) {
            show_error("No product found with id {$produce_code}", 500);
        }

        // dismantle previous baskets
        if ($this->session->has_userdata('basket')) {
            $basket = unserialize($this->session->userdata('basket'));
        } else {
            $basket = array();
        }

        // add our new item to that basket.
        $basket[] = $produce_code;

        // then recreate the basket into the session.
        $this->session->set_userdata('basket', serialize($basket));

        // debug.
        var_dump($this->session->userdata('basket'));
    }

    /**
     * Delete the items in the basket.
     */
    public function delete($produce_code)
    {
        $basket = $this->session->userdata('basket');

        var_dump($basket);
    }
}