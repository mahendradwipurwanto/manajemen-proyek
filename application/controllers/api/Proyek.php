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
        
        $this->load->model(['api/M_proyek', 'api/M_auth']);

        if($this->session->userdata('role') == 3){
            if ($this->M_auth->cekIfLeader($this->session->userdata('user_id'))['status'] == true) {
                $session_data = array(
                    'is_leader' => true,
                );
    
                $this->session->set_userdata($session_data);
            }
        }
    }

    function cekSessionProyek(){
        if(!$this->session->userdata('proyek')){
            if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1){
                redirect(site_url('admin/kelola-proyek'));
            }else{
                redirect(site_url('staff/kelola-proyek'));
            }
        }
    }

    public function detailTask()
    {
        $this->cekSessionProyek();

        $task = $this->M_proyek->getProyekTask($this->session->userdata('proyek')['id']);

        if($this->session->userdata('role') == 3){
            if ($this->M_auth->cekIfLeaderProyek($this->session->userdata('user_id'), $this->session->userdata('proyek')['id'])['status'] == true) {
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
        // ej($task);
        $data['status'] = $task[$this->input->post('status')];
        $data['task'] = $task[$this->input->post('status')]->tasks[$this->input->post('task')];
        $data['komentar'] = $this->M_proyek->getTaskKomentar($task[$this->input->post('status')]->tasks[$this->input->post('task')]->id);
        $data['bukti'] = $this->M_proyek->getTaskBukti($task[$this->input->post('status')]->tasks[$this->input->post('task')]->id);
        $data['statusAll'] = $this->M_proyek->getProyekStatus($this->session->userdata('proyek')['kode']);
        $data['staff'] = $this->M_proyek->getStaffProyek($this->session->userdata('proyek')['id'], 1);
        // ej($data);

        $this->load->view('proyek/task', $data);
    }

    public function selesaikanTaskEdit()
    {
        $this->cekSessionProyek();

        $data['task'] = $this->M_proyek->getTaskById($this->input->post('task_id'));
        $data['proyek'] = $this->M_proyek->getProyekById($this->session->userdata('proyek')['id']);

        $this->load->view('proyek/ajax/edit_task', $data);
    }

    public function ajaxEditProyek()
    {
        $this->cekSessionProyek();

        $data['proyek'] = $this->M_proyek->getProyekById($this->session->userdata('proyek')['id']);
        
        $this->load->view('proyek/ajax/edit_proyek', $data);
    }

    public function save()
    {
        if(isset($_FILES['file'])){
            $path = "berkas/proyek/";
            $upload = $this->uploader->uploadFile($_FILES['file'], $path);

            if($upload['status'] == true){
                if($this->input->post('leader') > 0){
                    if($this->M_proyek->cekKodeProyek($this->input->post('kode'))){
                        if ($this->M_proyek->save($upload['filename']) == true) {
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
                }else{
                    $this->session->set_flashdata('notif_warning', 'Harap pilih leader proyek !');
                    redirect($this->agent->referrer());
                }
            }else{
                    $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mengunggah file pendukung proyek anda !');
                    redirect($this->agent->referrer());

            }

        }else{
            if($this->input->post('leader') > 0){
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
            }else{
                $this->session->set_flashdata('notif_warning', 'Harap pilih leader proyek !');
                redirect($this->agent->referrer());
            }
        }
    }

    public function edit()
    {
        if(isset($_FILES['file'])){
            $path = "berkas/proyek/";
            $upload = $this->uploader->uploadFile($_FILES['file'], $path);

            if($upload['status'] == true){
                if ($this->M_proyek->edit($upload['filename']) == true) {
                    // log
                    $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Mengubah informasi proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                    $this->session->set_flashdata('notif_success', 'Berhasil mengubah informasi proyek baru');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba mengubah informasi proyek baru');
                    redirect($this->agent->referrer());
                }
            }else{
                    $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mengunggah file pendukung proyek anda !');
                    redirect($this->agent->referrer());

            }

        }else{
            if ($this->M_proyek->edit() == true) {
                // log
                $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Mengubah informasi proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

                $this->session->set_flashdata('notif_success', 'Berhasil mengubah informasi proyek baru');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'Berhasil mengubah informasi proyek baru');
                redirect($this->agent->referrer());
            }
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

    public function tutup()
    {
        if ($this->M_proyek->tutup() == true) {
            
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'menutup proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil menutup proyek baru');
            if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1){
                redirect(site_url('admin/kelola-proyek'));
            }else{
                redirect(site_url('leader/kelola-proyek'));
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menutup proyek');
            redirect($this->agent->referrer());
        }
    }

    public function assignStaff()
    {
        $this->cekSessionProyek();
        
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
        $this->cekSessionProyek();

        if($this->input->post('staff') != null){
            if ($this->M_proyek->assignStaffBulk() == true) {
                // log
                $this->M_proyek->insert_log($this->input->post('proyek')['id'], 'Menambahkan staff kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

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
        $this->cekSessionProyek();

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
        $this->cekSessionProyek();

        // if($this->M_proyek->sisaBobotProyek($this->input->post('proyek_id')) == null || $this->M_proyek->sisaBobotProyek($this->input->post('proyek_id'))->quota_bobot > 100){
            if ($this->M_proyek->tambah_task() == true) {
                // log
                $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menambahkan Task baru kedalam proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');
                $this->M_proyek->insert_logNotif($this->session->userdata('proyek')['id'], 'Kamu telah menerima task baru pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>', $this->input->post('staff_id'));

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
        $this->cekSessionProyek();

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
        $this->cekSessionProyek();

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
        $this->cekSessionProyek();

        if ($this->M_proyek->selesaikan_task() == true) {
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menyelesaikan Task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');
            $this->M_proyek->insert_logNotif($this->session->userdata('proyek')['id'], 'Kamu telah menyelesaikan task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>', $this->session->userdata('user_id'));

            $this->session->set_flashdata('notif_success', 'Berhasil menyelesaikan task');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyelesaikan task');
            redirect($this->agent->referrer());
        }


        // if (isset($_FILES['file'])) {
        //     $path = "berkas/proyek/{$this->input->post('proyek_id')}/{$this->session->userdata('user_id')}/bukti/";
        //     $upload = $this->uploader->uploadFile($_FILES['file'], $path);
            
        //     if ($upload == true) {
        //         if ($this->M_proyek->selesaikan_task($upload['filename']) == true) {
        //             // log
        //             $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menyelesaikan Task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

        //             $this->session->set_flashdata('notif_success', 'Berhasil menyelesaikan task');
        //             redirect($this->agent->referrer());
        //         } else {
        //             $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyelesaikan task');
        //             redirect($this->agent->referrer());
        //         }
        //     } else {
        //         $this->session->set_flashdata('notif_warning', $upload['message']);
        //         redirect($this->agent->referrer());
        //     }
        // } else {
        //     if($this->input->post('sudah_upload') == 1){
        //         if ($this->M_proyek->selesaikan_task(null) == true) {
        //             // log
        //             $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menyelesaikan Task pada proyek  <b>'.$this->session->userdata('proyek')['judul'].'</b>');

        //             $this->session->set_flashdata('notif_success', 'Berhasil menyelesaikan task');
        //             redirect($this->agent->referrer());
        //         } else {
        //             $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menyelesaikan task');
        //             redirect($this->agent->referrer());
        //         }
        //     }else{
        //         $this->session->set_flashdata('notif_warning', 'Harap sertakan bukti penyelesaian !');
        //         redirect($this->agent->referrer());
        //     }
        // }
    }

    public function tolakTask()
    {
        $this->cekSessionProyek();

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
        $this->cekSessionProyek();
        
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

    public function tambahKomentar()
    {
        if ($this->M_proyek->tambahKomentar() == true) {
            // log
            $this->M_proyek->insert_log($this->session->userdata('proyek')['id'], 'Menambahkan komentar pada task <b>'.$this->input->post('task').'</b>');

            $this->session->set_flashdata('notif_success', 'Berhasil menambahkan komentar');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan komentar');
            redirect($this->agent->referrer());
        }
    }

    public function hapusKomentar($id)
    {
        if ($this->M_proyek->hapusKomentar($id) == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus komentar');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menghapus komentar');
            redirect($this->agent->referrer());
        }
    }

    function upload_bukti($proyek_id, $task_id){
		// ATUR FOLDER UPLOAD BUKTI
		$folder 			= "berkas/proyek/{$proyek_id}/{$task_id}/bukti/";

		if (!is_dir($folder)) {
			mkdir($folder, 0755, true);
		}

		// $string_file 	= "bukti-{$task_id}_".substr(time(), 3);

		$config['upload_path']          = $folder;
		$config['allowed_types']        = '*';
		$config['max_size']             = 10*1024;
		$config['overwrite']            = false;
		// $config['file_name']            = $string_file;
        
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('bukti'))
		{
			$upload_data 	= $this->upload->data();
            // ej($upload_data);
            $data = [
                'task_id' => $task_id,
                'bukti' => "berkas/proyek/{$proyek_id}/{$task_id}/bukti/".$upload_data['file_name'],
                'created_at' => time(),
                'created_by' => $this->session->userdata('user_id')
            ];
			$models = $this->db->insert('tb_task_bukti', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
		}else{
            return false;
        }
	}

	function delete_bukti($proyek_id, $task_id){
        $filename = $this->input->post('filename');
        $filename = str_replace(" ", "_", $filename);
		$this->db->where('bukti', $filename);
		$this->db->update('tb_task_bukti', ['is_deleted' => 1]);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
        if($cek == true){
            unlink(base_url()."berkas/proyek/{$proyek_id}/{$task_id}/bukti/{$filename}");
        }
        return $cek;
	}

    function upload_pendukung($proyek_id = null){
		// ATUR FOLDER UPLOAD BUKTI
        if($proyek_id == null){
            $query = $this->db->query("SELECT MAX(id) as id FROM tb_proyek");
            $proyek_id = $query->row()->id;

            $proyek_id = $proyek_id+1;
        }

		$folder 			= "berkas/proyek/{$proyek_id}/pendukung/";

		if (!is_dir($folder)) {
			mkdir($folder, 0755, true);
		}


		// $string_file 	= "bukti-{$task_id}_".substr(time(), 3);

		$config['upload_path']          = $folder;
		$config['allowed_types']        = '*';
		$config['max_size']             = 10*1024;
		$config['overwrite']            = false;
		// $config['file_name']            = $string_file;
        
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('pendukung'))
		{
			$upload_data 	= $this->upload->data();
            // ej($upload_data);
            $data = [
                'proyek_id' => $proyek_id,
                'file' => "berkas/proyek/{$proyek_id}/pendukung/".$upload_data['file_name'],
                'created_at' => time(),
                'created_by' => $this->session->userdata('user_id')
            ];
			$models = $this->db->insert('tb_proyek_file', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
		}else{
            return false;
        }
	}

	function delete_pendukung($proyek_id){
        $filename = $this->input->post('filename');
        $filename = str_replace(" ", "_", $filename);
		$this->db->where('file', $filename);
		$this->db->update('tb_proyek_file', ['is_deleted' => 1]);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
        if($cek == true){
            unlink(base_url()."berkas/proyek/{$proyek_id}/pendukung/{$filename}");
        }
        return $cek;
	}
}
