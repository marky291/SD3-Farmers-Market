<?php

/**
 * Class Order_model
 *
 * @property CI_DB_query_builder $db
 */
class Order_model extends MY_Model
{
    public function sumCountsPerYearOf($productCode)
    {
        $currentYear = 2019;

        $items = $this->db
            ->select('Year(orderDate) as date')
            ->from('orderdetails')
            ->join('orders', 'orders.orderNumber = orderdetails.orderNumber', 'inner')
            ->where('productCode', $productCode)
            ->get()
            ->result();

        for ($i = 0; $i < 20; $i++) {
            $years[$currentYear-$i] = 0;
        }
        foreach ($items as $item) {
            $years[$item->date]++;
        }

        return $years;
    }
}