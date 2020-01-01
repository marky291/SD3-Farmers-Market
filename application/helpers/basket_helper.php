<?php

/**
 * Check the user is logged in.
 *
 * @return boolean
 */
function GetTotalBasketItems()
{
    if (get_instance()->session->has_userdata('basket')) {
        return array_sum($user = get_instance()->session->userdata('basket'));
    }

    return 0;
}

function GetBasketItemCount($produceCode)
{
    $basket = get_instance()->session->userdata('basket');

    if (isset($basket[$produceCode])) {
        return $basket[$produceCode];
    }

    return 0;
}