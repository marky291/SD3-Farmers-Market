<?php

/**
 * Class Controller
 *
 * @property CI_Input $input
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
}