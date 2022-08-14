<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

        if ($this->session->userdata('role') == 2) {
            $this->session->set_flashdata('warning', "You don`t have access to this page");
            redirect(base_url());
        }

        $this->load->model(['M_admin']);
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $this->templateback->view('admin/dashboard');
    }

    public function kelola_leader()
    {
        $this->templateback->view('admin/leader');
    }

    public function kelola_staff()
    {
        $this->templateback->view('admin/staff');
    }

    public function kelola_proyek()
    {
        $this->templateback->view('admin/proyek');
    }

    public function pengaturan()
    {
        
        $page = $this->input->get('p');

        switch ($page) {
            case 'general':

                $this->templateback->view('admin/pengaturan/general');
                break;

            case 'credentials':
                $data['super_account'] = $this->M_admin->get_superAccount();
                $data['admin_account'] = $this->M_admin->get_adminAccount();

                $this->templateback->view('admin/settings/credentials', $data);
                break;

            case 'mailer':
                $data['mailer_mode'] = $this->M_admin->get_settingsValue('mailer_mode');
                $data['mailer_host'] = $this->M_admin->get_settingsValue('mailer_host');
                $data['mailer_port'] = $this->M_admin->get_settingsValue('mailer_port');
                $data['mailer_alias'] = $this->M_admin->get_settingsValue('mailer_alias');
                $data['mailer_username'] = $this->M_admin->get_settingsValue('mailer_username');
                $data['mailer_password'] = $this->M_admin->get_settingsValue('mailer_password');

                $this->templateback->view('admin/pengaturan/mailer', $data);
                break;
            
            default:
                $this->templateback->view('admin/pengaturan');
                break;
        }
    }
}
