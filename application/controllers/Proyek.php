<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends CI_Controller
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

        if($this->session->userdata('role') == 3){
            if ($this->M_auth->cekIfLeader($this->session->userdata('user_id'))['status'] == true) {
                $session_data = array(
                    'is_leader' => true,
                );
    
                $this->session->set_userdata($session_data);
            }
        }
    }

    public function kelola($kode = null)
    {

        $data['user'] = $this->M_auth->get_userByID($this->session->userdata('user_id'));
        $data['countDashboard'] = $this->M_staff->countDashboardStaff();
        
        $proyekDetail = $this->M_proyek->getDetail($kode);
        $proyek = [
            'id' => $proyekDetail->id,
            'kode' => $proyekDetail->kode,
            'judul' => $proyekDetail->judul,
            'keterangan' => $proyekDetail->keterangan,
            'upload_type' => $proyekDetail->upload_type,
            'periode_mulai' => $proyekDetail->periode_mulai,
            'periode_selesai' => $proyekDetail->periode_selesai,
            'status' => $proyekDetail->status
        ];
        $this->session->set_userdata(['proyek' => $proyek]);

        if($this->session->userdata('role') == 3){
            if ($this->M_auth->cekIfLeaderProyek($this->session->userdata('user_id'), $proyekDetail->id)['status'] == true) {
                $session_data = array(
                    'is_leader' => true,
                );
    
                $this->session->set_userdata($session_data);
            }else{
                $session_data = array(
                    'is_leader' => false,
                );
    
                $this->session->set_userdata($session_data);
            }
        }

        $data['proyek'] = $this->M_proyek->getDetail($kode);
        $data['bobot'] = $this->M_proyek->sisaBobotProyek($proyekDetail->id);
        $data['log_proyek'] = $this->M_proyek->getLogProyek($proyekDetail->id);
        $data['status'] = $this->M_proyek->getProyekStatus($kode, 1);
        $data['task'] = $this->M_proyek->getProyekTask($proyekDetail->id);
        $data['leader'] = $this->M_proyek->getLEaderProyek($proyekDetail->id, 1);
        $data['staff'] = $this->M_proyek->getStaffProyek($proyekDetail->id, 1);
        // ej($data['leader']);
        if ($this->agent->is_mobile()) {
            if($this->session->userdata('role') == 3){
                $this->templateback->view('staff/task', $data);
            }else{
                $this->templatemobile->view('proyek/detail', $data);
            }
        } else {
            if($this->session->userdata('role') == 3){
                $this->templateback->view('staff/task', $data);
            }else{
                $this->templateback->view('proyek/detail', $data);
            }
        }
    }

    public function kpi()
    {
        $periode = [];
        if($this->input->post('periode')){
            $periode = explode(' - ', $this->input->post('periode'));
            // ej($periode);
        }
        $proyek = null;
        $data['nama_proyek']= "Semua Proyek";
        if($this->input->get('proyek')){
            $proyek = $this->input->get('proyek') == 0 ? null : $this->input->get('proyek');
            
            if($proyek > 0){
                $data['nama_proyek']     = $this->M_proyek->getProyekById($proyek)->judul;
            }
        }

        $data['proyek']     = $this->M_proyek->getAllProyek();
        $data['kpi']        = $this->M_proyek->getDataKPI($periode, $proyek);
        $data['chart_kpi']  = $this->M_proyek->getChartKPI($periode, $proyek);
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/kpi', $data);
        }else{
            $this->templateback->view('proyek/kpi', $data);
        }
    }

    public function laporan()
    {
        $periode = [];
        if($this->input->post('periode')){
            $periode = explode(' - ', $this->input->post('periode'));
            // ej($periode);
        }

        $data['proyek'] = $this->M_proyek->getLaporanProyek($periode);
        $data['tasks'] = $this->M_proyek->getTasksLaporanAll($periode);
        
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/laporan', $data);
        }else{
            $this->templateback->view('proyek/laporan', $data);
        }
    }

    public function master_status($kode = null)
    {
        $data['countStaff'] = $this->M_staff->countStaff();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['staff'] = $this->M_staff->getStaff();
        $data['undanganStaff'] = $this->M_master->getUndangan(3);
        $data['proyek'] = $this->M_proyek->getDetail($kode);
        $data['status'] = $this->M_proyek->getProyekStatus($kode);
        // ej($data);
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/status', $data);
        } else {
            $this->templateback->view('proyek/status', $data);
        }
    }
    
    public function kelola_staff($kode = null){
        $proyek_id = $this->M_proyek->getProyekId($kode);
        $data['proyek_kode'] = $kode;
        $data['proyek_id'] = $proyek_id;
        $data['staff'] = $this->M_proyek->getStaffProyek($proyek_id, 1);
        $data['staff_free'] = $this->M_proyek->getStaffProyek($proyek_id, 0);
        // ej($data);
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/staff', $data);
        } else {
            $this->templateback->view('proyek/staff', $data);
        }
    }

    public function kelola_task($id = null)
    {
        $data['countStaff'] = $this->M_staff->countStaff();
        $data['jabatan'] = $this->M_master->getJabatan();
        $data['staff'] = $this->M_staff->getStaff();
        $data['undanganStaff'] = $this->M_master->getUndangan(3);
        $data['proyek'] = $this->M_proyek->getAll();

        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/task', $data);
        } else {
            $this->templateback->view('proyek/task', $data);
        }
    }
}
