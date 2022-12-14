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
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyimpan jabatan');
            redirect($this->agent->referrer());
        }
    }

    public function hapusJabatan()
    {
        if ($this->M_master->hapusJabatan() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus jabatan');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menghapus jabatan');
            redirect($this->agent->referrer());
        }
    }

    function testMailer(){
        sendMailTest($this->input->post('email'), 'Test email mailer', 'This is a Test Email on '.date('d M Y - H:i:s'))['status'];
        $this->session->set_flashdata('notif_success', 'Succesfuly tested mailer for the current setting');
        $debug = sendMailTest($this->input->post('email'), 'Test email mailer', 'This is a Test Email on '.date('d M Y - H:i:s'))['debug'] == 'html' ? 'Test mail succesfuly sended' : sendMailTest($this->input->post('email'), 'Test email mailer', 'This is a Test Email on '.date('d M Y - H:i:s'))['debug'];
        $this->session->set_userdata(['mailer_debug' => $debug]);
        redirect($this->agent->referrer());
    }
}
