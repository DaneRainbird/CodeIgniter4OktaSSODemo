<?php

namespace App\Controllers;

class Home extends BaseController {

    /**
     * View function for the index page
     */
    public function index() {
        return view('home', [
            'username' => session()->get('username'),
            'success' => session()->getFlashdata('success'),
        ]);
    }
}
