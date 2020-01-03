<?php

/**
 * Class Customer_model
 *
 * @property CI_DB_query_builder $db
 * @property Bcrypt $bcrypt
 */
class Customer_model extends CI_Model
{
    /**
     * @var string
     */
    public $customerNumber;
    /**
     * @var string
     */
    public $customerName;
    /**
     * @var string
     */
    public $contactLastName;
    /**
     * @var string
     */
    public $contactFirstName;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $addressLine1;
    /**
     * @var string
     */
    public $addressLine2;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $postalCode;
    /**
     * @var string
     */
    public $country;
    /**
     * @var integer
     */
    public $creditLimit;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;
    /**
     * @var integer
     */
    public $loginAttempts;
    /**
     * @var string
     */
    public $remember_token;
    /**
     * @var integer
     */
    public $is_admin;

    /**
     * @return Customer_model
     */
    public function firstWhereEmail($email)
    {
        return $this->db->get_where('customers', ['email' => $email])->first_row('customer_model');
    }

    /**
     * Set the remember me token
     *
     * @param $value
     * @return $this
     */
    public function setRememberMeToken($value)
    {
        $this->remember_token = $value;

        return $this;
    }

    /**
     * Generate a remember me token for authentication through cookies.
     *
     * @return string
     */
    public function generateRememberMeToken()
    {
        try {
            $this->setRememberMeToken(bin2hex(random_bytes(16)));
        } catch (Exception $e) {
            $this->generateRememberMeToken();
        }

        return $this->remember_token;
    }

    /**
     * Clear the remember token from the user.
     *
     * @return $this
     */
    public function clearRememberMeToken()
    {
        $this->remember_token = null;

        delete_cookie('remember_me');

        return $this;
    }

    /**
     * Increment the login attempts on the account by an amount.
     *
     * @param int $count
     * @return $this
     */
    public function incrementLoginAttempt($count = 1)
    {
        return $this->setLoginAttempts($this->loginAttempts += $count);
    }

    /**
     * Set the login attempts of the user.
     *
     * @param $value
     * @return Customer_model
     */
    public function setLoginAttempts($value)
    {
        $this->loginAttempts = $value;

        return $this;
    }

    /**
     * The object can persist all changed to itself on the database.
     *
     * @return boolean
     */
    public function update()
    {
        return $this->db->update('customers', $this, ['customerNumber' => $this->customerNumber], 1);
    }

    /**
     * Save the object as an new entity in the database with the attributes
     *
     * @param array $attributes
     * @return Customer_model
     */
    public function save($attributes = array())
    {
        // insert into database,
        $this->db->insert('customers', $attributes);

        // return the object we created in database (ORM)
        return $this->firstWhereEmail($attributes['email']);
    }

    /**
     * Get the user with the remember me token.
     *
     * @param $value
     * @return mixed
     */
    public function firstWhereRememberMeToken($value)
    {
        return $this->db->get_where('customers', ['remember_token' => $value])->first_row('customer_model');
    }

    /**
     * Return if the user has admin role
     *
     * @return boolean
     */
    public function hasAdminRole()
    {
        return $this->is_admin;
    }
}