<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
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

        $this->load->model(['api/M_auth', 'api/M_leader', 'api/M_staff', 'api/M_master', 'api/M_proyek']);
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data['user'] = $this->M_auth->get_userByID($this->session->userdata('user_id'));
        $data['countDashboard'] = $this->M_staff->countDashboardStaff();
        $data['countLeader'] = $this->M_leader->countLeader();
        $data['proyek'] = $this->M_proyek->getAll();

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('staff/dashboard', $data);
        } else {
            $this->templateback->view('staff/dashboard', $data);
        }
    }

    public function kelola_proyek()
    {
        $data['user'] = $this->M_auth->get_userByID($this->session->userdata('user_id'));
        $data['countDashboard'] = $this->M_staff->countDashboardStaff();
        $data['countStaff'] = $this->M_staff->countStaff();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['staff'] = $this->M_staff->getStaff();
        $data['undanganStaff'] = $this->M_master->getUndangan(3);
        $data['proyekAktif'] = $this->M_staff->getProyekStaffAll(1);
        $data['proyekArsip'] = $this->M_staff->getProyekStaffAll(2);

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('staff/proyek', $data);
        } else {
            $this->templateback->view('staff/proyek', $data);
        }
    }

    public function task($kode = null)
    {
        $proyekDetail = $this->M_proyek->getDetail($kode);
        $proyek = [
            'id' => $proyekDetail->id,
            'kode' => $proyekDetail->kode,
            'judul' => $proyekDetail->judul,
            'keterangan' => $proyekDetail->keterangan,
            'periode_mulai' => $proyekDetail->periode_mulai,
            'periode_selesai' => $proyekDetail->periode_selesai,
            'status' => $proyekDetail->status
        ];
        
        $this->session->set_userdata(['proyek' => $proyek]);

        $data['proyek'] = $this->M_proyek->getDetail($kode);
        $data['log_proyek'] = $this->M_proyek->getLogProyek($proyekDetail->id);
        $data['status'] = $this->M_proyek->getProyekStatus($kode);
        $data['task'] = $this->M_proyek->getProyekTask($proyekDetail->id);
        $data['staff'] = $this->M_proyek->getStaffProyek($proyekDetail->id, 1);

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('staff/task', $data);
        } else {
            $this->templateback->view('staff/task', $data);
        }
    }

    public function pengaturan()
    {
        $data['user'] = $this->M_auth->get_userByID($this->session->userdata('user_id'));

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('staff/pengaturan', $data);
        } else {
            $this->templateback->view('staff/pengaturan', $data);
        }
    }
}
