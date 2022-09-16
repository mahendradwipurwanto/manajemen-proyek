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
        if(!$this->session->userdata('proyek')){
            if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1){
                redirect(site_url('admin/kelola-staff'));
            }else{
                redirect(site_url('leader/kelola-staff'));
            }
        }
        $this->load->model(['api/M_proyek']);
    }

    public function detailTask()
    {
        $task = $this->M_proyek->getProyekTask($this->session->userdata('proyek')['id']);
        // ej($task);
        // ej($this->input->post('task'));
        $data['status'] = $task[$this->input->post('status')];
        $data['task'] = $task[$this->input->post('status')]->tasks[$this->input->post('task')];
        $data['statusAll'] = $this->M_proyek->getProyekStatus($this->session->userdata('proyek')['kode']);
        $data['staff'] = $this->M_proyek->getStaffProyek($this->session->userdata('proyek')['id'], 1);
        $this->load->view('proyek/task', $data);
    }

    public function save()
    {
        if($this->M_proyek->cekKodeProyek($this->input->post('kode'))){
            if ($this->M_proyek->save() == true) {
                $this->session->set_flashdata('notif_success', 'Berhasil menambahkan proyek baru');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan proyek baru');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'Kode telah digunakan, harap ganti kode proyek anda !');
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

    public function hapus($id)
    {
        if ($this->M_proyek->hapus($id) == true) {
            
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menghapus proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil menghapus proyek baru');
            if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1){
                redirect(site_url('admin/kelola-proyek'));
            }else{
                redirect(site_url('leader/kelola-proyek'));
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menghapus proyek baru');
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
        // if($this->M_proyek->sisaBobotProyek($this->input->post('proyek_id')) == null || $this->M_proyek->sisaBobotProyek($this->input->post('proyek_id'))->quota_bobot > 100){
            if ($this->M_proyek->tambah_task() == true) {
                // log
                $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menambahkan Task baru kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                $this->session->set_flashdata('notif_success', 'Berhasil menambahkan task baru');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan task baru');
                redirect($this->agent->referrer());
            }
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'Total bobot task melebihi 100%');
        //     redirect($this->agent->referrer());
        // }
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

    public function selesaikanTask()
    {
        if (isset($_FILES['file'])) {
            $path = "berkas/proyek/{$this->input->post('proyek_id')}/{$this->session->userdata('user_id')}/bukti/";
            $upload = $this->uploader->uploadFile($_FILES['file'], $path);
            
            if ($upload == true) {
                if ($this->M_proyek->selesaikan_task($upload['filename']) == true) {
                    // log
                    $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menyelesaikan Task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                    $this->session->set_flashdata('notif_success', 'Berhasil menyelesaikan task');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyelesaikan task');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            if($this->input->post('sudah_upload') == 1){
                if ($this->M_proyek->selesaikan_task(null) == true) {
                    // log
                    $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menyelesaikan Task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                    $this->session->set_flashdata('notif_success', 'Berhasil menyelesaikan task');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyelesaikan task');
                    redirect($this->agent->referrer());
                }
            }else{
                $this->session->set_flashdata('notif_warning', 'Harap sertakan bukti penyelesaian !');
                redirect($this->agent->referrer());
            }
        }
    }

    public function tolakTask()
    {
        if ($this->M_proyek->tolak_task() == true) {
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menolak Task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil menolak task');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menolak task');
            redirect($this->agent->referrer());
        }
    }

    public function verifikasiTask()
    {
        if ($this->M_proyek->verifikasi_task() == true) {
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Memverifikasi Task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil verifikasi task');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba verifikasi task');
            redirect($this->agent->referrer());
        }
    }

    public function sematkan($id, $status)
    {
        if ($this->M_proyek->sematkan($id, $status) == true) {
            // log
            $this->M_proyek->insert_log($id, 'Menyematkan proyek');

            $this->session->set_flashdata('notif_success', 'Berhasil menyematkan proyek');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyematkan proyek');
            redirect($this->agent->referrer());
        }
    }
}
