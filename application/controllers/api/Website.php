<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_website']);
    }

    public function ubahGeneral()
    {
        if ($this->M_website->ubahGeneral() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah informasi general');
            redirect(site_url('admin/pengaturan?p=general'));
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahaan, saat mengubah informasi general');
            redirect($this->agent->referrer());
        }
    }

    public function ubahMailer()
    {
        if ($this->M_website->ubahMailer() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah informasi mailer');
            redirect(site_url('admin/pengaturan?p=mailer'));
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahaan, saat mengubah informasi mailer');
            redirect($this->agent->referrer());
        }
    }

    public function ubahPasswordMaster()
    {
        if ($this->M_website->ubahPasswordMaster() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah informasi keamanan');
            redirect(site_url('admin/pengaturan?p=keamanan'));
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahaan, saat mengubah informasi keamanan');
            redirect($this->agent->referrer());
        }
    }
}
