<?php

/**
 * Class Controller
 *
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 */
class MY_Controller extends CI_Controller
{
    /**
     * Check  if the current url is a post request method.
     *
     * @return bool
     */
    public function isPostMethod()
    {
        return $this->input->method() === 'POST';
    }

    /**
     * Check  if the current url is a get request method.
     *
     * @return bool
     */
    public function isGetMethod()
    {
        return $this->input->method() === 'GET';
    }

    /**
     * Invert the form validation run function.
     *
     * @return bool
     */
    public function failsFormValidation()
    {
        return $this->form_validation->run() === false;
    }
}