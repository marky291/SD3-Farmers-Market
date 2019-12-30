<?php

/**
 * Class Auth
 *
 * @property Bcrypt $bcrypt
 */
class Auth extends MY_Controller
{
    public function login()
    {
        //
    }

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