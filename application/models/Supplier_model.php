<?php

/**
 * Class Supplier_model
 *
 * @property CI_DB_query_builder $db
 */
class Supplier_model extends MY_Model
{
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $contact;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $photo;

    /**
     * Get all suppliers from the database.
     *
     * @return array
     */
    public function all()
    {
        return $this->db->get('suppliers')->result('supplier_model');
    }

    /**
     * Get the supplier where the id matches
     *
     * @param $key
     * @return mixed
     */
    public function firstWhereId($key)
    {
        return $this->db->get_where('suppliers', ['id' => $key])->first_row('supplier_model');
    }
}