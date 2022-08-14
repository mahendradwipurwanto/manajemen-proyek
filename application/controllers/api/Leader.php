<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leader extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_leader', 'api/M_master', 'api/M_auth']);
    }

    function undang(){
        $email = htmlspecialchars($this->input->post('email'), true);
        
        if($this->M_master->cekUndangan($email) === 0){
            if($this->M_master->undang(2) == true){

                // mengirimkan email selamat bergabung
                $subject = "Undangan menjadi leader";
                $message = `Hi, kamu telah diundang untuk menjadi leader.<br> Harap click tombol dibawah ini untuk membuat akun leader! <br><hr><br><center><a href="' . base_url() . 'register?act=undangan-leader&email={$email}" style="background-color: #377dff;border:none;color:#fff;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;">Bergabung Sekarang</a></center><br><br>atau click link dibawah ini: <br>' . base_url() . 'register?act=undangan-leader&email={$email}`;

                sendMail($email, $subject, $message);

                $this->session->set_flashdata('notif_success', 'Berhasil mengundang leader');
                redirect(site_url('admin/kelola-leader'));
            }else{
                $this->session->set_flashdata('warning', 'Terjadi kesalahan saat mengundang');
                redirect($this->agent->referrer());
            }
        }else{
            $this->session->set_flashdata('warning', 'Telah terdapat undangan atas email tersebut!');
            redirect($this->agent->referrer());
        }
    }

    function kirimUndangan($email = null){
        $this->M_master->logUndangan($email);
        // mengirimkan email selamat bergabung
        $subject = "Undangan menjadi leader";
        $message = 'Hi, kamu telah diundang untuk menjadi leader.<br> Harap click tombol dibawah ini untuk membuat akun leader! <br><hr><br><center><a href="' . base_url() . 'daftar?act=undangan-leader&email='.$email.'" style="background-color: #377dff;border:none;color:#fff;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;">Bergabung Sekarang</a></center><br><br>atau click link dibawah ini: <br>' . base_url() . 'daftar?act=undangan-leader&email='.$email;

        sendMail($email, $subject, $message);

        $this->session->set_flashdata('notif_success', 'Berhasil mengirim ulang undangan leader');
        redirect(site_url('admin/kelola-leader'));
    }

    function tambahLeader(){
        // menerimaemaildan password serta memparse karakter spesial
        $nama = htmlspecialchars($this->input->post('nama'), true);
        $email = htmlspecialchars($this->input->post('email'), true);
        $password = htmlspecialchars($this->input->post('password'), true);
        $password_ver = htmlspecialchars($this->input->post('confirmPassword'), true);
         // cek apakahemailvalid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // cek apakah password sama dengan konfirmasi password
            if ($password == $password_ver) {
                // cek apakahemailtelah digunakan
                if ($this->M_auth->get_auth($email) == false) {
                    if ($this->M_leader->tambahLeader() == true) {

                        // mengirimkan email selamat bergabung
                        $subject = "Selamat bergabung";
                        $message = "Hi {$nama}, kamu telah ditambahkan sebagai akun leader pada website kami";

                        sendMail($email, $subject, $message);

                        $this->session->set_flashdata('notif_success', 'Berhasil menambahkan leader');
                        redirect(site_url('admin/kelola-leader'));
                    } else {
                        $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan leader');
                        redirect($this->agent->referrer());
                    }
                } else {
                    $this->session->set_flashdata('warning', 'Email telah digunakan!');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('warning', 'Password tidak sesuai!');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('warning', 'Email tidal valid, harap masukkan email yang valid!');
            redirect($this->agent->referrer());
        }
    }

    function simpanPengaturan(){
        if (isset($_FILES['image'])) {
            $path = "berkas/user/{$this->session->userdata('user_id')}/profile/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            
            if ($upload == true) {
                if ($this->M_master->updateProfile($upload['filename']) == true) {
                    $session = [
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                    ];

                    $this->session->set_userdata($session);

                    $this->session->set_flashdata('notif_success', 'Informasi akunmu telah diubah');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'Kamu tidak mengubah informasi akunmu');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            if ($this->M_master->updateProfile(null) == true) {
                $session = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                ];

                $this->session->set_userdata($session);

                $this->session->set_flashdata('notif_success', 'Informasi akunmu telah diubah');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'Kamu tidak mengubah informasi akunmu');
                redirect($this->agent->referrer());
            }
        }
    }
}
