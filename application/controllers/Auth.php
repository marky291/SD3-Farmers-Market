<?php

/**
 * Class Auth
 *
 * @property Bcrypt $bcrypt
 * @property CI_Form_validation $form_validation
 * @property Customer_model $customer_model
 * @property CI_Session $session
 */
class Auth extends MY_Controller
{

    /**
     * Login the user to the application.
     */
    public function login()
    {
        // check if get request or if the form validation fails.
        if ($this->isGetMethod() || $this->failsFormValidation()) {
            return $this->load->view('auth/login');
        }

        // get the matching user from the database with the email.
        /** @var Customer_model $user */
        $user = $this->customer_model->firstWhereEmail($this->input->post('email'));

        // we let a failure fall through for security.
        if (isset($user))
        {
            if ($this->isValidPassword($user)) {
                $this->session->set_userdata('auth', serialize($user));
                // display previous attempts on the account
                $this->session->set_flashdata('attempts', $user->loginAttempts);
                // reset the login attempts since we logged in.
                $user->setLoginAttempts(0)->update();
                // back to dashboard.
                $this->redirectToController('/');
            } else {
                // we increment the login attempts on failure. k.
                $user->incrementLoginAttempt()->update();
                // lets tell the user how many attempts failed.
                $this->session->set_flashdata('attempts', $user->loginAttempts);
            }
        }

        // everything else we will pretend its an incorrect email and password.
        $this->session->set_flashdata('error', 'Email or password incorrect');

        // clear any previous data from the form.
        $this->clearFormInputs();
    }

    /**
     * Logout the user from the application.
     */
    public function logout()
    {
        // clear the user data.
        $this->session->unset_userdata('auth');
        // back to dashboard.
        $this->redirectToController('/');
    }

    /**
     * @param Customer_model $user
     * @return bool
     */
    public function isValidPassword(Customer_model $user)
    {
        return $this->bcrypt->check_password($this->input->post('password'), $user->password);
    }
}