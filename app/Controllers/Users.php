<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\OktaService; 

class Users extends BaseController {

    // Variables
    protected $okta;

    /**
     * Constructor fnction
     */
    public function __construct() {
        $this->okta = new OktaService();
    }

    /**
     * Login function
     * 
     * Begins the Okta login process
     * 
     * @return void redirect to the home page 
     */
    public function login() {
        // If the user isn't already logged in, then generate an authorization url
        if (!session()->get('username')) {
            $state = bin2hex(random_bytes(5));
            $authorizeUrl = $this->okta->buildAuthorizeUrl($state);
            session()->set('state', $state);

            // Redirect to the authorisation URL on Okta's servers
            return redirect()->to($authorizeUrl);
        }

        // If user is already logged in, redirect to return URL or home page
        if (session()->get('returnUrl')) {
            $returnUrl = session()->get('returnUrl');
            session()->remove('returnUrl');
            return redirect()->to($returnUrl);
        }

        return redirect()->to('/');
    }

    /**
     * Callback function
     * 
     * Handles the callback from the Okta login process and redirects accordingly
     * 
     * @return void redirect to the home page
     */
    public function callback() {
        
        // If the callback URL contains an Okta code, then proceed with authorisation
        if ($this->request->getUri()->getQuery(['only' => ['code']])) {
            $result = $this->okta->authorizeUser(session()->get('state'));

            // If there is an error with the authorization, then redirect to an error page
            if (isset($result['error'])) {
                echo $result['errorMessage'];
                die();
            }
        }

        // If successful login then set session values
        session()->set('username', $result['username']);
        session()->setFlashdata('success', 'You have successfully logged in!');

        // Redirect to return URL (if provided) or home page
        if (session()->get('returnUrl')) {
            $returnUrl = session()->get('returnUrl');
            session()->remove('returnUrl');
            return redirect()->to($returnUrl);
        }

        return redirect()->to('/');
    }

    /**
     * Logout function
     * 
     * Logs the user out of the application by removing stored session values
     * 
     * @return void redirect to homepage
     */
    public function logout() {
        // Destroy the session on logout
        session()->destroy();

        return redirect()->to('/');
    }
}