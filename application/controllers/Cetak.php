<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['api/M_auth', 'api/M_leader', 'api/M_staff', 'api/M_master', 'api/M_proyek']);
    }

    public function kpi($proyek_id = null)
    {
        $data['nama_proyek']= "Semua Proyek";
        $proyek_id = $proyek_id == 0 ? null : $proyek_id;

        if(!is_null($proyek_id)){
            $data['nama_proyek']     = $this->M_proyek->getProyekById($proyek_id)->judul;
        }

        $data['proyek']     = $this->M_proyek->getAllProyek();
        $data['kpi']        = $this->M_proyek->getDataKPI([], $proyek_id);
        $data['chart_kpi']  = $this->M_proyek->getChartKPI([], $proyek_id);
        $this->templateprint->view('proyek/cetak/kpi', $data);
    }
}
