<?php

/**
 * Check the user is logged in.
 *
 * @return boolean
 */
function authenticated()
{
    return get_instance()->session->has_userdata('auth');
}

/**
 * Return the logged in user.
 *
 * @return Customer_model
 */
function user()
{
    $user = get_instance()->session->userdata('auth');

    return unserialize($user);
}