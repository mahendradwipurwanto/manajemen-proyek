<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $this->templateback->view('cms/dashboard');
    }
}
