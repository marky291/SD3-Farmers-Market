<?php

function valid($value, $error)
{
    if ($error == '') {
        return $value;
    }

    if ($error) {
        return 'is-invalid';
    }

    return 'is-valid';
}