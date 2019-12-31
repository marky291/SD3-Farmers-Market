<?php

/**
 * Class Customer_model
 *
 * @property CI_DB_query_builder $db
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
     * @return Customer_model
     */
    public function firstWhereEmail($email)
    {
        return $this->db->get_where('customers', ['email' => $email])->first_row('customer_model');
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
}