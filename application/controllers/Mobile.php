<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mobile extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();

        if (!$this->agent->is_mobile()) {
            redirect('home');
        }
    }

    public function dashboard()
    {
        $this->templateback->view('mobile/intercept');
    }
}
