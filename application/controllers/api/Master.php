<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_master']);
    }

    public function simpanJabatan()
    {
        if ($this->M_master->simpanJabatan() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menyimpan jabatan');
            redirect(site_url('admin/pengaturan/?p=jabatan'));
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyimpan jabatan');
            redirect($this->agent->referrer());
        }
    }

    public function hapusJabatan()
    {
        if ($this->M_master->hapusJabatan() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus jabatan');
            redirect(site_url('admin/pengaturan/?p=jabatan'));
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menghapus jabatan');
            redirect($this->agent->referrer());
        }
    }

    function testMailer(){
        if (sendMail($this->input->post('email'), 'Test email mailer', 'This is a Test Email on '.date('d M Y - H:i:s')) == true) {
            $this->session->set_flashdata('success', 'Succesfuly tested mailer for the current setting');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('warning', 'There is a problem when trying to test mailer, try again later');
            redirect($this->agent->referrer());
        }
    }
}
