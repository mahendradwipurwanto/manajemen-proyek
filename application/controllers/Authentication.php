<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_auth']);
    }

    public function login()
    {
        $this->templateauth->view('authentication/login');
    }

    public function proseslogin()
    {
        $this->templateauth->view('authentication/login');
    }

    public function register()
    {
        $this->templateauth->view('authentication/register');
    }

    public function lupa_password()
    {
        $this->templateauth->view('authentication/forgot');
    }

    public function reset_password($token = null)
    {
        // cek apakah token valid
        if ($this->M_auth->get_tokenReset($token) == false) {
            $this->session->set_flashdata('error', 'Token link tidak diketahui, harap mengulang permintaan reset password jika hal ini masih terjadi');
            redirect(site_url('masuk'));
        } else {

            // mengambil data token
            $data_token = $this->M_auth->get_tokenReset($token);

            // mengambil data user berdasarkan kode user
            $user = $this->M_auth->get_userByID($data_token->user_id);

            // cek apakah waktu token valid kurang dari 24 jam
            if (time() - $data_token->date_created < (60 * 60 * 24)) {
                $data['email'] = $user->email;
                $data['token'] = $token;
                $this->templateauth->view('authentication/reset', $data);
            } else {

                // menghapus token reset, meminta mengulangi proses
                $this->M_auth->del_token($user->user_id, 2);

                $this->session->set_flashdata('error', 'Token reset password telah kadaluarsa, harap melakukan proses reset password kembali.');
                redirect(site_url('forgot-password'));
            }
        }

    }

    public function verifikasi_email()
    {

        // cek apakah user sudah masuk
        if ($this->session->userdata('logged_in') == true) {
            $email = htmlspecialchars($this->session->userdata('email'), true);

            // cek apakah terdapat data verifikasi
            if ($this->M_auth->get_verifikasi(htmlspecialchars($this->session->userdata('user_id'), true)) != false) {
                // mengambil data verifikasi
                $verifikasi = $this->M_auth->get_verifikasi(htmlspecialchars($this->session->userdata('user_id'), true));
                
                // cek apakah status masih belum verifikasi
                if ($verifikasi->status == 0) {

                    // cek apakah mengirim permintaan pengiriman email verifikasi
                    if ($this->input->get('act') == "send-email") {
                        $subject = "Kode verifikasi";
                        $message = "Kode verifikasimu : <br><br><center><h1 style='font-size: 62px;'>{$this->encryption->decrypt($verifikasi->key)}</h1></center><br><br><small class='text-muted'>Kode verifikasimu hanya akan valid selama 1x24 jam. <span class='text-danger'>Jika telah kadaluarsa harap lakukan kembali proses aktivasi akun anda</b>.</span></small>";

                        // mengirim email
                        if (sendMail($email, $subject, $message) == true) {
                            $this->session->set_flashdata('success', 'Pendaftaran berhasil, harap masukkan kode verfikasi email yang telah kami kirimkan ke email anda !');
                        } else {
                            $this->session->set_flashdata('notif_error', 'Terjadi kesalahan saat mengirimkan email kode aktivasi anda !');
                            redirect(site_url('verifikasi-email'));
                        }
                    } elseif ($this->input->get('act') == "resend-email") {
                        $subject = "Kode verifikasi";
                        $message = "Kode verifikasimu : <br><br><center><h1 style='font-size: 62px;'>{$this->encryption->decrypt($verifikasi->key)}</h1></center><br><br><small class='text-muted'>Kode aktivasimu hanya akan valid selama 1x24 jam. <span class='text-danger'>Jika telah kadaluarsa harap lakukan kembali proses aktivasi akun anda.</span></small>";

                        // mengirim email
                        if (sendMail($email, $subject, $message) == true) {
                            $this->session->set_flashdata('success', 'Berhasil mengirim kan email ke ' . $email . ' !');
                        } else {
                            $this->session->set_flashdata('notif_error', 'Terjadi kesalahan saat mengirimkan email kode aktivasi anda !');
                            redirect(site_url('verifikasi-email'));
                        }
                    }

                    $data['mail'] = $email;
                    $data['activation_code'] = $this->encryption->decrypt($verifikasi->key);
                    $this->templateauth->view('authentication/verifikasi');
                } else {
                    $this->session->set_flashdata('notif_warning', 'Akunmu telah terverifikasi !');
                    redirect(base_url());
                }

            } else {
                $this->session->set_flashdata('notif_error', 'Terjadi kesalahan saat mencoba mendapatkan informasi akunmu !');
                redirect(site_url('masuk'));

            }
        } else {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->unset_userdata('redirect');
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Harap masuk untuk melanjutkan");
            redirect('masuk');
        }
    }
}
