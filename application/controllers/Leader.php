<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Leader extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();

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

        $this->load->model(['api/M_auth', 'api/M_leader', 'api/M_staff', 'api/M_master', 'api/M_proyek']);
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data['countDashboard'] = $this->M_leader->countLeaderDashboard();
        $data['log_proyek'] = $this->M_proyek->getLogProyekLeader();
        $data['proyek'] = $this->M_proyek->getAll();
        
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('leader/dashboard', $data);
        }else{
            $this->templateback->view('leader/dashboard', $data);
        }
    }

    public function kpi()
    {

        $data['kpi'] = $this->M_proyek->getDataKPI();
        
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('leader/kpi', $data);
        }else{
            $this->templateback->view('leader/kpi', $data);
        }
    }

    public function kelola_staff()
    {
        $data['countStaff'] = $this->M_staff->countStaff();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['staff'] = $this->M_staff->getStaff();
        $data['undanganStaff'] = $this->M_master->getUndangan(3);
        $data['proyek'] = $this->M_proyek->getAllStatus(1);

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('leader/staff', $data);
        }else{
            $this->templateback->view('leader/staff', $data);
        }
    }

    public function kelola_proyek()
    {
        $data['countStaff'] = $this->M_staff->countStaff();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['staff'] = $this->M_staff->getStaff();
        $data['undanganStaff'] = $this->M_master->getUndangan(3);
        $data['proyekAktif'] = $this->M_proyek->getAllStatus(1);
        $data['proyekArsip'] = $this->M_proyek->getAllStatus(2);
        // ej($data);
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/proyek', $data);
        }else{
            $this->templateback->view('proyek/proyek', $data);
        }
    }

    public function pengaturan()
    {
        
        $page = $this->input->get('p');

        switch ($page) {

            case 'jabatan':
                $data['jabatan'] = $this->M_master->getJabatan();

                if ($this->agent->is_mobile()) {
                    $this->templatemobile->view('admin/pengaturan/jabatan', $data);
                }else{
                    $this->templateback->view('admin/pengaturan/jabatan', $data);
                }
                break;
            
            default:

                $data['user'] = $this->M_auth->get_userByID($this->session->userdata('user_id'));
                
                if ($this->agent->is_mobile()) {
                    $this->templatemobile->view('leader/pengaturan', $data);
                }else{
                    $this->templateback->view('leader/pengaturan', $data);
                }
                break;
        }
    }

    
}
