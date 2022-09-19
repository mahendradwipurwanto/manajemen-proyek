<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

        if ($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3) {
            $this->session->set_flashdata('warning', "You don`t have access to this page");
            redirect(base_url());
        }

        $this->load->model(['M_admin', 'api/M_leader', 'api/M_staff', 'api/M_master', 'api/M_proyek']);
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data['count'] = $this->M_admin->countDashboard();
        $data['log_proyek'] = $this->M_proyek->getLogProyek();
        $data['proyek'] = $this->M_proyek->getAll();

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('admin/dashboard', $data);
        }else{
            $this->templateback->view('admin/dashboard', $data);
        }
    }

    public function kelola_pengguna()
    {
        $data['countLeader'] = $this->M_leader->countLeader();

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('admin/mobile/pengguna', $data);
        }else{
            $this->templateback->view('admin/mobile/pengguna', $data);
        }
    }

    public function kelola_leader()
    {
        $data['countLeader'] = $this->M_leader->countLeader();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['leader'] = $this->M_leader->getLeader();
        $data['undanganLeader'] = $this->M_master->getUndangan(2);

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('admin/leader', $data);
        }else{
            $this->templateback->view('admin/leader', $data);
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
            $this->templatemobile->view('admin/staff', $data);
        }else{
            $this->templateback->view('admin/staff', $data);
        }

    }

    public function kelola_proyek()
    {
        $periode = [];
        if($this->input->post('periode')){
            $periode = explode(' - ', $this->input->post('periode'));
            // ej($periode);
        }
        $data['countStaff'] = $this->M_staff->countStaff();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['staff'] = $this->M_staff->getStaff();
        $data['undanganStaff'] = $this->M_master->getUndangan(3);
        $data['proyekAktif'] = $this->M_proyek->getAllStatus(1, $periode);
        $data['proyekArsip'] = $this->M_proyek->getAllStatus(2, $periode);
        // ej($data['proyekAktif'][0]->leader);
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
            case 'general':

                if ($this->agent->is_mobile()) {
                    $this->templatemobile->view('admin/pengaturan/general');
                }else{
                    $this->templateback->view('admin/pengaturan/general');
                }
                break;

            case 'credentials':
                $data['super_account'] = $this->M_admin->get_superAccount();
                $data['admin_account'] = $this->M_admin->get_adminAccount();

                if ($this->agent->is_mobile()) {
                    $this->templatemobile->view('admin/settings/credentials', $data);
                }else{
                    $this->templateback->view('admin/settings/credentials', $data);
                }
                break;

            case 'mailer':
                $data['mailer_mode'] = $this->M_admin->get_settingsValue('mailer_mode');
                $data['mailer_host'] = $this->M_admin->get_settingsValue('mailer_host');
                $data['mailer_port'] = $this->M_admin->get_settingsValue('mailer_port');
                $data['mailer_smtp'] = $this->M_admin->get_settingsValue('mailer_smtp');
                $data['mailer_alias'] = $this->M_admin->get_settingsValue('mailer_alias');
                $data['mailer_username'] = $this->M_admin->get_settingsValue('mailer_username');
                $data['mailer_password'] = $this->M_admin->get_settingsValue('mailer_password');

                if ($this->agent->is_mobile()) {
                    $this->templatemobile->view('admin/pengaturan/mailer', $data);
                }else{
                    $this->templateback->view('admin/pengaturan/mailer', $data);
                }
                break;

            case 'jabatan':
                $data['jabatan'] = $this->M_master->getJabatan();

                if ($this->agent->is_mobile()) {
                    $this->templatemobile->view('admin/pengaturan/jabatan', $data);
                }else{
                    $this->templateback->view('admin/pengaturan/jabatan', $data);
                }
                break;
            
            default:

                if ($this->agent->is_mobile()) {
                    $this->templatemobile->view('admin/pengaturan');
                }else{
                    $this->templateback->view('admin/pengaturan');
                }
                break;
        }
    }
}
