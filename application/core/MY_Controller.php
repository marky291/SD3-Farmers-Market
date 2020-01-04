<?php

/**
 * Class Controller
 *
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property Customer_model $customer_model
 * @property CI_Session $session
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

    /**
     * Hacky way of clearing the form data, is redirecting back to itself.
     */
    public function clearFormInputs()
    {
        redirect(current_url());
    }

    /**
     * Sometimes u wanna redirect ot another controller, since that handles data
     * for the page. we dont want to handle that shit.
     * @param $controller
     */
    public function redirectToController($controller)
    {
        redirect($controller);
    }

    /**
     * Get the json data from the request.
     *
     * @return mixed
     */
    public function getJsonAssociativeArray()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}