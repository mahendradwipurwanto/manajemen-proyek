<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_staff', 'api/M_master', 'api/M_auth']);
    }

    function undang(){
        $email = htmlspecialchars($this->input->post('email'), true);
        
        if($this->M_master->cekUndangan($email) === 0){
            if($this->M_master->undang(3) == true){

                // mengirimkan email telah diundang
                $subject = "Undangan menjadi staff";
                $message = 'Hi, kamu telah diundang untuk menjadi staff.<br> Harap click tombol dibawah ini untuk membuat akun staff! <br><hr><br><center><a href="' . base_url() . 'daftar?act=undangan-staff&email='.$email.'" style="background-color: #377dff;border:none;color:#fff;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;">Bergabung Sekarang</a></center><br><br>atau click link dibawah ini: <br>' . base_url() . 'daftar?act=undangan-staff&email='.$email;

                sendMail($email, $subject, $message);

                $this->session->set_flashdata('notif_success', 'Berhasil mengundang staff');
                if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1){
                    redirect(site_url('admin/kelola-staff'));
                }else{
                    redirect(site_url('leader/kelola-staff'));
                }
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
        // mengirimkan email telah diundang
        $subject = "Undangan menjadi staff";
        $message = 'Hi, kamu telah diundang untuk menjadi staff.<br> Harap click tombol dibawah ini untuk membuat akun staff! <br><hr><br><center><a href="' . base_url() . 'daftar?act=undangan-staff&email='.$email.'" style="background-color: #377dff;border:none;color:#fff;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;">Bergabung Sekarang</a></center><br><br>atau click link dibawah ini: <br>' . base_url() . 'daftar?act=undangan-staff&email='.$email;

        sendMail($email, $subject, $message);

        $this->session->set_flashdata('notif_success', 'Berhasil mengirim ulang undangan staff');
        if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1){
            redirect(site_url('admin/kelola-staff'));
        }else{
            redirect(site_url('leader/kelola-staff'));
        }
    }

    function tambahStaff(){
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
                    if ($this->M_staff->tambahStaff() == true) {

                        // mengirimkan email selamat bergabung
                        $subject = "Selamat bergabung";
                        $message = "Hi {$nama}, kamu telah ditambahkan sebagai akun staff pada website kami";

                        sendMail($email, $subject, $message);

                        $this->session->set_flashdata('notif_success', 'Berhasil menambahkan staff');
                        if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1){
                            redirect(site_url('admin/kelola-staff'));
                        }else{
                            redirect(site_url('leader/kelola-staff'));
                        }
                    } else {
                        $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba menambahkan staff');
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
}
