<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $this->load->library('excel');

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

    public function ekspor_kpi($proyek_id = null)
    {
        $nama_proyek = "Semua Proyek";
        $proyek_id = $proyek_id == 0 ? null : $proyek_id;

        if(!is_null($proyek_id)){
            $nama_proyek      = $this->M_proyek->getProyekById($proyek_id)->judul;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true, 'color' => array('rgb' => 'ffffff')], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'ff377dff')
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $kpi = $this->M_proyek->getDataKPI([], $proyek_id);

        $sheet->setCellValue('A1', "Laporan KPI Proyek - ".$nama_proyek); // Set kolom A1
        $sheet->mergeCells('A1:O1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "Peringkat"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Staff"); // Set kolom E3
        $sheet->setCellValue('C3', "Proyek"); // Set kolom E3
        // $sheet->setCellValue('G3', "Presentase"); // Set kolom C3
        // $sheet->setCellValue('G3', "Nilai"); // Set kolom B3

        $sheet->setCellValue('C4', "Total Proyek"); // Set kolom C3
        $sheet->setCellValue('D4', "Total Task"); // Set kolom C3
        $sheet->setCellValue('E4', "Ditolak/Proses"); // Set kolom C3
        $sheet->setCellValue('F4', "Selesai"); // Set kolom C3

        $sheet->mergeCells('A3:A4');
        $sheet->mergeCells('B3:B4');
        $sheet->mergeCells('C3:F3');
        // $sheet->mergeCells('G3:G4');
        // $sheet->mergeCells('H3:H4');

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3:A4')->applyFromArray($style_col);
        $sheet->getStyle('B3:B4')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        // $sheet->getStyle('G3:G4')->applyFromArray($style_col);
        // $sheet->getStyle('H3:H4')->applyFromArray($style_col);
        
        $sheet->getStyle('C4')->applyFromArray($style_col);
        $sheet->getStyle('D4')->applyFromArray($style_col);
        $sheet->getStyle('E4')->applyFromArray($style_col);
        $sheet->getStyle('F4')->applyFromArray($style_col);


        if(!empty($kpi)){
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
            foreach ($kpi as $data) { // Lakukan looping pada variabel siswa
                $sheet->setCellValue('A'.$numrow, $no);
                $sheet->setCellValue('B'.$numrow, $data->nama);
                $sheet->setCellValue('C'.$numrow, $data->totalProyek);
                $sheet->setCellValue('D'.$numrow, $data->totalTask);
                $sheet->setCellValue('E'.$numrow, $data->taskProses);
                $sheet->setCellValue('F'.$numrow, $data->taskSelesai);
                // $sheet->setCellValue('G'.$numrow, $data->persentase."%");
                // $sheet->setCellValue('G'.$numrow, $data->nilai);

            
                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
                // $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
                // $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);

            
                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
            }
        }else{
            $sheet->setCellValue('A5', "belum ada data"); // Set kolom A1
            $sheet->mergeCells('A4:F4'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->getStyle('A5')->getFont()->setBold(true); // Set bold kolom A1
        }
            // Set width kolom
        $sheet->getColumnDimension('A')->setAutoSize(true); // Set width kolom A
        $sheet->getColumnDimension('B')->setAutoSize(true); // Set width kolom B
        $sheet->getColumnDimension('C')->setAutoSize(true); // Set width kolom C
        $sheet->getColumnDimension('D')->setAutoSize(true); // Set width kolom D
        $sheet->getColumnDimension('E')->setAutoSize(true); // Set width kolom E
        $sheet->getColumnDimension('F')->setAutoSize(true); // Set width kolom E
        // $sheet->getColumnDimension('G')->setAutoSize(true); // Set width kolom E
        // $sheet->getColumnDimension('H')->setAutoSize(true); // Set width kolom E
    
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $title = "Data-KPI-".date("dMY").".xlsx";
        $sheet->setTitle($title);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$title.'"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function kpi()
    {
        $periode = [];
        // if($this->input->get('periode')){
        //     $periode = explode(' - ', $this->input->get('periode'));
        //     // ej($periode);
        // }
        $proyek = null;
        $data['nama_proyek']= "Semua Proyek";
        if($this->input->get('proyek')){
            $proyek = $this->input->get('proyek') == 0 ? null : $this->input->get('proyek');
            
            if($proyek > 0){
                $data['nama_proyek']     = $this->M_proyek->getProyekById($proyek)->judul;
            }
        }

        $data['nama_staff']= "Semua Staff";
        $staff = null;
        if($this->input->get('staff')){
            $staff = $this->input->get('staff') == 0 ? null : $this->input->get('staff');
            
            if($staff > 0){
                $data['nama_staff']     = $this->M_auth->get_userByID($staff)->nama;
            }
        }

        $data['proyek']     = $this->M_proyek->getAllProyek();
        $data['kpi']        = $this->M_proyek->getDataKPI($periode, $proyek);
        $data['chart_kpi']  = $this->M_proyek->getChartKPI($periode, $proyek);
        
        $data['staff']      = $this->M_staff->getStaff();
        $data['kpi_manual']        = $this->M_proyek->getManualKPI($proyek, $staff, $periode);
        $data['chart_kpi_manual']  = $this->M_proyek->getManualKPIGrafik($proyek, $staff, $periode);
        // ej($data['kpi']);
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/kpi', $data);
        }else{
            $this->templateback->view('proyek/kpi', $data);
        }
    }

    public function kpi_staff()
    {
        $periode = [];
        if($this->input->get('periode')){
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
        if($this->input->get('staff')){
            $staff = $this->input->get('staff') == 0 ? null : $this->input->get('staff');
            
            if($staff > 0){
                $data['nama_staff']     = $this->M_auth->get_userByID($staff)->nama;
            }
        }

        $data['proyek']     = $this->M_proyek->getAllProyek();
        $data['staff']     = $this->M_staff->getStaff();
        $data['kpi']        = $this->M_proyek->getManualKPI($proyek, $staff, $periode);
        $data['chart_kpi']  = $this->M_proyek->getManualKPIGrafik($proyek, $staff, $periode);
        // ej($data['chart_kpi']);
        if ($this->agent->is_mobile()) {
            $this->templatemobile->view('proyek/kpi_manual', $data);
        }else{
            $this->templateback->view('proyek/kpi_manual', $data);
        }
    }

    public function laporan()
    {
        $periode = [];
        if($this->input->get('periode') && $this->input->get('periode') != "" && $this->input->get('periode') != null){
            $periode = explode(' - ', $this->input->get('periode'));
            // ej($periode);
        }

        $proyek = null;
        $data['nama_proyek']= "Harap pilih proyek";
        $data['proyek_id'] = null;
        if($this->input->get('proyek')){
            $proyek = $this->input->get('proyek') == 0 ? null : $this->input->get('proyek');
            
            if($proyek > 0){
                $data['nama_proyek']     = $this->M_proyek->getProyekById($proyek)->judul;
                $data['proyek_id']     = $this->M_proyek->getProyekById($proyek)->id;
            }
        }

        $data['proyek']     = $this->M_proyek->getAllProyek();
        // $data['proyekdata'] = $this->M_proyek->getLaporanStatusProyek($periode, $proyek);
        $data['proyekdata'] = $this->M_proyek->getLaporanStatusProyekNew($proyek, $periode);
        $data['tasks'] = $this->M_proyek->getLaporanStatusTaskProyek($proyek, $periode);
        $data['staff_target'] = $this->M_proyek->getStaffTargetTask($proyek, $periode);
        $data['staff_main'] = $this->M_proyek->getLaporanTaskStaff($proyek, $periode);
        $data['tabel_target'] = $this->M_proyek->getStaffTargetTaskTabel($proyek, $periode);
        $data['tabel_main'] = $this->M_proyek->getLaporanTaskStaffTabel($proyek, $periode);
        $data['proyek_status'] = $this->M_proyek->getProyekStatusLaporan($proyek, $periode);
        // ej($data['proyekdata']);
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
