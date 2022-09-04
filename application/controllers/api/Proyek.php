<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_proyek']);
    }

    public function detailTask()
    {
        // ej($this->input->post('task'));
        $data['task'] = $this->input->post('task');
        $data['status'] = $this->input->post('status');
        $this->load->view('proyek/task', $data);
    }

    public function save()
    {

        if ($this->M_proyek->save() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menambahkan proyek baru');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan proyek baru');
            redirect($this->agent->referrer());
        }
    }

    public function edit()
    {
        if ($this->M_proyek->edit() == true) {
            
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Mengubah informasi proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil mengubah informasi proyek baru');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba mengubah informasi proyek baru');
            redirect($this->agent->referrer());
        }
    }

    public function assignStaff()
    {
        if($this->M_proyek->cekAssignStaff(1) == 0){
            if ($this->M_proyek->assignStaff() == true) {

                // log
                $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menambahkan staff kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                $this->session->set_flashdata('notif_success', 'Berhasil menugaskan staff kedalam proyek yang diatur');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menugaskan staff kedalam proyek yang diatur');
                redirect($this->agent->referrer());
            }
        }else{
            $this->session->set_flashdata('notif_warning', 'Staff telah ditugaskan dan masih aktif dalam proyek tersebut');
            redirect($this->agent->referrer());
        }
    }

    public function assignStaffBulk()
    {
        if($this->input->post('staff') != null){
            if ($this->M_proyek->assignStaffBulk() == true) {
                // log
                // $this->M_proyek->insert_log($this->input->post('proyek')['id'], 'Menambahkan staff kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                $this->session->set_flashdata('notif_success', 'Berhasil menugaskan staff kedalam proyek yang diatur');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menugaskan staff kedalam proyek yang diatur');
                redirect($this->agent->referrer());
            }
        }else{
            $this->session->set_flashdata('notif_warning', 'Tidak ada staff yang dipilih');
            redirect($this->agent->referrer());
        }
    }

    public function keluarkanStaff($proyek_id, $user_id)
    {
        if ($this->M_proyek->keluarkanStaff($proyek_id, $user_id) == true) {
                // log
                $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Mengeluarkan staff dari proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');
                
            $this->session->set_flashdata('notif_success', 'Berhasil mengeluarkan staff dari proyek ini');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba mengeluarkan staff dari proyek ini');
            redirect($this->agent->referrer());
        }
    }

    public function tambah_status()
    {
        if ($this->M_proyek->tambah_status() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menambahkan master status');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan master status');
            redirect($this->agent->referrer());
        }
    }

    public function edit_status()
    {
        if ($this->M_proyek->edit_status() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah master status');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba mengubah master status');
            redirect($this->agent->referrer());
        }
    }

    public function hapus_status()
    {
        if ($this->M_proyek->hapus_status() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus master status');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menghapus master status');
            redirect($this->agent->referrer());
        }
    }

    public function tambahTask()
    {
        if($this->M_proyek->sisaBobotProyek($this->input->post('proyek_id'))->quota_bobot > 100){
            if ($this->M_proyek->tambah_task() == true) {
                // log
                $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menambahkan Task baru kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                $this->session->set_flashdata('notif_success', 'Berhasil menambahkan task baru');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan task baru');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'Total bobot task melebihi 100%');
            redirect($this->agent->referrer());
        }
    }

    public function editTask()
    {
        if ($this->M_proyek->edit_task() == true) {
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Mengubah Task baru kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil mengubah task baru');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba mengubah task baru');
            redirect($this->agent->referrer());
        }
    }

    public function hapusTask($id)
    {
        if ($this->M_proyek->hapus_task($id) == true) {
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menghapus Task baru kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil menghapus task baru');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menghapus task baru');
            redirect($this->agent->referrer());
        }
    }
}
