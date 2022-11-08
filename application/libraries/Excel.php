<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    protected $_ci;
  
    public function __construct()
    {
        log_message('Debug', 'PHPSpreadSheet class is loaded.');
        $this->_ci = &get_instance();
        $this->_ci->load->database();
        $this->_ci->load->model('api/M_proyek');
    }

    public function exporKPI($proyek_id = null)
    {
        $data['nama_proyek']= "Semua Proyek";
        $proyek_id = $proyek_id == 0 ? null : $proyek_id;

        if(!is_null($proyek_id)){
            $data['nama_proyek']     = $this->M_proyek->getProyekById($proyek_id)->judul;
        }

        $data['kpi']        = $this->M_proyek->getDataKPI([], $proyek_id);
        ej($data);
        $semua_pengguna = [];

        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'Nama')
                      ->setCellValue('C1', 'Jenis Kelamin')
                      ->setCellValue('D1', 'Tanggal Lahir')
                      ->setCellValue('E1', 'Umur');
        
        $kolom = 2;
        $nomor = 1;
        foreach ($semua_pengguna as $pengguna) {
            $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $pengguna->nama)
                           ->setCellValue('C' . $kolom, $pengguna->jenis_kelamin)
                           ->setCellValue('D' . $kolom, date('j F Y', strtotime($pengguna->tanggal_lahir)))
                           ->setCellValue('E' . $kolom, $pengguna->umur);
            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Export excel '.date("dMY").'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
