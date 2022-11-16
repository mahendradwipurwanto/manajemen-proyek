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

    public function kpi_manual($proyek_id = null)
    {
        $periode = [];
        if ($this->input->get('periode')) {
            $periode = explode(' - ', $this->input->get('periode'));
        }

        $proyek = null;
        // $data['nama_proyek']= "Semua Proyek";
        // if($this->input->get('proyek')){
        //     $proyek = $this->input->get('proyek') == 0 ? null : $this->input->get('proyek');

        //     if($proyek > 0){
        //         $data['nama_proyek']     = $this->M_proyek->getProyekById($proyek)->judul;
        //     }
        // }

        $data['nama_staff']= "Semua Staff";
        $staff = null;
        if ($this->input->get('staff')) {
            $staff = $this->input->get('staff') == 0 ? null : $this->input->get('staff');

            if ($staff > 0) {
                $data['nama_staff']     = $this->M_auth->get_userByID($staff)->nama;
            }
        }

        $data['proyek']     = $this->M_proyek->getAllProyek();
        $data['staff']     = $this->M_staff->getStaff();
        $data['kpi']        = $this->M_proyek->getManualKPI($proyek, $staff, $periode);
        $data['chart_kpi']  = $this->M_proyek->getManualKPIGrafik($proyek, $staff, $periode);

        $this->templateprint->view('proyek/cetak/kpi_manual', $data);
    }

    public function laporan($proyek_id = null)
    {
        $data['nama_proyek']= "Semua Proyek";
        $proyek_id = $proyek_id == 0 ? null : $proyek_id;

        if(!is_null($proyek_id)){
            $data['nama_proyek']     = $this->M_proyek->getProyekById($proyek_id)->judul;
        }

        $data['proyek']     = $this->M_proyek->getAllProyek();
        $data['proyekdata'] = $this->M_proyek->getLaporanStatusProyek($proyek_id);
        $data['tasks'] = $this->M_proyek->getLaporanStatusTaskProyek($proyek_id);
        $data['staff_target'] = $this->M_proyek->getStaffTargetTask($proyek_id);
        $data['staff_main'] = $this->M_proyek->getLaporanTaskStaff($proyek_id);
        $data['tabel_target'] = $this->M_proyek->getStaffTargetTaskTabel($proyek_id);
        $data['tabel_main'] = $this->M_proyek->getLaporanTaskStaffTabel($proyek_id);
        $data['proyek_status'] = $this->M_proyek->getProyekStatusLaporan($proyek_id);
        $this->templateprint->view('proyek/cetak/laporan', $data);
    }
}
