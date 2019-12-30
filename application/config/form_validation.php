<?php

    // form validation.
    $config = array(
        'auth/login' => array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ),
        )
    );

    // set a default delimeter.
    $config['error_prefix'] = '';
    $config['error_suffix'] = '';