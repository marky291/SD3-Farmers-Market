<?php

function feedback($field)
{
    if (form_error($field)) {
        return 'is-invalid';
    }

    if (!set_value($field)) {
        return 'empty';
    }

    return 'is-valid';
}