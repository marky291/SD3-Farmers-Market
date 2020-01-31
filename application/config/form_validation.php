<?php

    // form validation.
    $config = array(
        'auth/login' => array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|min_length[5]|max_length[50]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[5]|max_length[50]'
            ),
        ),
        'auth/register' => array(
            array(
                'field' => 'company',
                'label' => 'Company',
                'rules' => 'required|min_length[2]|max_length[50]',
            ),
            array(
                'field' => 'forename',
                'label' => 'Forename',
                'rules' => 'required|min_length[3]|max_length[50]',
            ),
            array(
                'field' => 'surname',
                'label' => 'Surname',
                'rules' => 'required|min_length[3]|max_length[50]',
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[200]|is_unique[customers.email]',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[3]|max_length[50]',
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[password]',
            ),
            array(
                'field' => 'address_line_one',
                'label' => 'Address Line One',
                'rules' => 'required|min_length[3]|max_length[50]',
            ),
            array(
                'field' => 'address_line_two',
                'label' => 'Address Line Two',
                'rules' => 'required|min_length[3]|max_length[50]',
            ),
            array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required|alpha'
            ),
            array(
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required|alpha'
            ),
            array(
                'field' => 'eircode',
                'label' => 'Postal Code',
                'rules' => 'required|min_length[1]|max_length[8]' // dublin uses one number, some use space between the character
            ),
            array(
                'field' => 'phone',
                'label' => 'Phone Number',
                'rules' => 'required|min_length[9]|max_length[10]|numeric'
            ),
        ),
        'product/update' => array(
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required|min_length[3]|max_length[20]',
            ),
            array(
                'field' => 'supplier_id',
                'label' => 'Supplier',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'sale_price',
                'label' => 'Sale Price',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'stock',
                'label' => 'Stock Quantity',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'required|min_length[25]|max_length[1500]'
            ),
        ),
        'product/save' => array(
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required|min_length[3]|max_length[20]',
            ),
            array(
                'field' => 'supplier_id',
                'label' => 'Supplier',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'sale_price',
                'label' => 'Sale Price',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'required|min_length[25]|max_length[1500]'
            ),
        ),
    );

    // set a default delimeter.
    $config['error_prefix'] = '';
    $config['error_suffix'] = '';