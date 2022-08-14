<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Leader extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();

        if ($this->agent->is_mobile()) {
            redirect('mobile');
        }

        // cek apakah user sudah masuk
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Please login to continue");
            redirect('masuk');
        }

        if ($this->session->userdata('role') == 3) {
            $this->session->set_flashdata('warning', "You don`t have access to this page");
            redirect(base_url());
        }

        $this->load->model(['api/M_auth', 'api/M_leader', 'api/M_staff', 'api/M_master']);
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data['countLeader'] = $this->M_leader->countLeader();

        $this->templateback->view('leader/dashboard', $data);
    }

    public function kpi()
    {

        $this->templateback->view('leader/kpi');
    }

    public function kelola_staff()
    {
        $data['countStaff'] = $this->M_staff->countStaff();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['staff'] = $this->M_staff->getStaff();
        $data['undanganStaff'] = $this->M_master->getUndangan(3);

        $this->templateback->view('leader/staff', $data);
    }

    public function kelola_proyek()
    {
        $this->templateback->view('leader/proyek');
    }

    public function pengaturan()
    {
        $data['user'] = $this->M_auth->get_userByID($this->session->userdata('user_id'));
        $this->templateback->view('leader/pengaturan', $data);
    }
}
