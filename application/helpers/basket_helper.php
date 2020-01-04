<?php

    /**
     * Could be a class... but lazy...
     *
     * @return float|int
     */
    function BasketTotalCount()
    {
        if (get_instance()->session->has_userdata('basket')) {
            return array_sum($user = get_instance()->session->userdata('basket'));
        }

        return 0;
    }

    /**
     * Could be a class... but lazy...
     *
     * @param $product
     * @return float|int
     */
    function BasketProductCount($product)
    {
        $basket = get_instance()->session->userdata('basket');

        if (!isset($basket[$product->produceCode])) {
            return 0;
        }

        return $basket[$product->produceCode];
    }

    /**
     * Could be a class... but lazy...
     *
     * @param array $products
     * @return float|int
     */
    function BasketTotalCollectionPrice($products = array())
    {
        $basketTotalPrice = 0.00; // total for the basket items
        $basket = get_instance()->session->userdata('basket');

        if (!isset($basket)) {
            return 0;
        }

        /** @var Product_model $product */
        foreach ($products as $product) {
            $basketTotalPrice += BasketTotalProductPrice($product);
        }

        return $basketTotalPrice;
    }

    /**
     * Could be a class... but lazy...
     *
     * @param $product
     * @return float|int
     */
    function BasketTotalProductPrice($product)
    {
        $basket = get_instance()->session->userdata('basket');

        if (!$product instanceof Product_model) {
            return 0;
        }

        if (!isset($basket[$product->produceCode])) {
            return 0;
        }

        return $basket[$product->produceCode] * $product->bulkSalePrice;
    }