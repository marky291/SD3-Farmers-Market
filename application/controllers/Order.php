<?php

/**
 * Class Order
 *
 * @property Order_model $order_model
 */
class Order extends MY_Controller
{
    public function timeline($productCode)
    {
        echo json_encode($this->order_model->sumCountsPerYearOf($productCode));
    }
}