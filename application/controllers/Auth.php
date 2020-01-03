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

        // persistence login through cookies.
        if ($this->input->post('remember_me'))
        {
            $token = $user->generateRememberMeToken();

            set_cookie('remember_me', $token, (86400 * 7)); // set for 7 days.

            $user->update(); // update the user in db with the token we generated.
        }

        // we let a failure fall through for security.
        if (isset($user))
        {
            if ($this->isValidPassword($user))
            {
                // store the user in the session
                $this->session->set_userdata('auth', serialize($user));

                // display previous attempts on the account if they exist!
                if ($user->loginAttempts) {
                    $this->session->set_flashdata('danger', "{$user->loginAttempts} failed password attempt(s) were previously made on your account.");
                }
                // reset the login attempts since we logged in.
                $user->setLoginAttempts(0)->update();

                // back to dashboard.
                $this->redirectToController('/');
            }
            else
            {
                // we increment the login attempts on failure. k.
                $user->incrementLoginAttempt()->update();

                // lets tell the user how many attempts failed.
                $this->session->set_flashdata('failed', $user->loginAttempts);
            }
        }

        // everything else we will pretend its an incorrect email and password.
        $this->session->set_flashdata('error', 'Email or password incorrect');

        // clear any previous data from the form.
        $this->clearFormInputs();
    }

    /**
     * Register a new user to the application
     *
     * @return object|string
     */
    public function register() {
        // check if get request or if the form validation fails.
        if ($this->isGetMethod() || $this->failsFormValidation()) {
            return $this->load->view('auth/register');
        }

        // create customer with static like new
        $customer = (new Customer_model)->save(array(
            'customerName' => $this->input->post('company'),
            'contactFirstName' => $this->input->post('forename'),
            'contactLastName' => $this->input->post('surname'),
            'phone' => $this->input->post('phone'),
            'addressLine1' => $this->input->post('address_line_one'),
            'addressLine2' => $this->input->post('address_line_two'),
            'city' => $this->input->post('city'),
            'postalCode' => $this->input->post('eircode'),
            'country' => $this->input->post('country'),
            'email' => $this->input->post('email'),
            'password' => $this->bcrypt->hash_password($this->input->post('password'))
        )); // this saves to database.

        // delete any previous data we hold, same user + new profile.
        $this->clearStoredSessionData();

        // automatic sign in... wow
        $this->session->set_userdata('auth', serialize($customer));

        // welcome the user to the system
        $this->session->set_flashdata('success', "Registration complete! Welcome to the farmers market {$customer->contactFirstName} {$customer->contactLastName}!");

        // dashboard kool
        $this->redirectToController('/');
    }
    /**
     * Logout the user from the application.
     */
    public function logout()
    {
        // clear any data we are holding
        $this->clearStoredSessionData();

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

    /**
     * Clear any data we may have on the user.
     */
    public function clearStoredSessionData()
    {
        // clear the user data from session.
        $this->session->unset_userdata('auth');

        // clear the basket from the session.
        $this->session->unset_userdata('basket');

        // delete the remember me cookie if it exists.
        if (get_cookie('remember_me')) {
            delete_cookie('remember_me');
        }
    }
}