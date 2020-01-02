<?php

/**
 * Class RememberMeAuthentication
 *
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Customer_model $customer_model
 */
class RememberMeAuthentication
{
    public function login()
    {
        $igniter =& get_instance();

        // dont do anything if user already is logged in.
        if ($igniter->session->has_userdata('auth')) {
            return;
        }

        // grab the token from the cookie.
        $token = $igniter->input->cookie('remember_me');

        // does the token exist?
        if ($token === null) {
            return;
        }

        /** @var Customer_model $user */
        $user = $igniter->customer_model->firstWhereRememberMeToken($token);

        // wipe the cookie if the user does not exist.
        if ($user === null) {
            delete_cookie('remember_me');
            return;
        }

        // set the user data on the session.
        $igniter->session->set_userdata('auth', serialize($user));
    }
}