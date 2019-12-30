<?php

/**
 * Class Auth
 *
 * @property Bcrypt $bcrypt
 * @property CI_Form_validation $form_validation
 */
class Auth extends MY_Controller
{

    /**
     * Login the user to the application.
     */
    public function login()
    {
        // check if get request or if the form validation fails.
        if ($this->isGetMethod() || $this->failsFormValidation()) {
            return $this->load->view('auth/login');
        }
    }

    /**
     * Logout the user from the application.
     */
    public function logout()
    {
        //
    }

    /**
     * @param $value
     * @return mixed
     *
     * One way authentication system of password encryption.
     */
    public function encrypt($value) {
        return $this->bcrypt->hash_password($value);
    }
}