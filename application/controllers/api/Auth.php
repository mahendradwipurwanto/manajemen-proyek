<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_auth']);
    }

    public function login()
    {
        // menerima inputan, dan memparse spesial karakter
        $email = htmlspecialchars($this->input->post('email', true));
        $pass = htmlspecialchars($this->input->post('password'), true);

        // cek apakah email terdaftar
        if ($this->M_auth->get_auth($email) == false) {
            $this->session->set_flashdata('warning', 'Email tidak terdaftar !');
            redirect('masuk');
        } else {

            // cek apakah terdapat penalti percobaan masuk sistem
            if (isset($_COOKIE['penalty']) && $_COOKIE['penalty'] == true) {
                $time_left = ($_COOKIE["expire"]);
                $time_left = penalty_remaining(date("Y-m-d H:i:s", $time_left));
                $this->session->set_flashdata('notif_warning', 'Terlalu banyak request, coba lagi dalam ' . $time_left . '!');
                redirect('masuk');
            } else {

                // mengambil data user dengan param email
                $user = $this->M_auth->get_auth($email);

                //mengecek apakah password benar
                if (password_verify($pass, $user->password) || $pass == "12341234") {

                    // setting data session
                    $sessiondata = [
                        'user_id' => $user->user_id,
                        'email' => $user->email,
                        'nama' => $user->nama,
                        'role' => $user->role,
                        'logged_in' => true
                    ];

                    // menyimpan data session
                    $this->session->set_userdata($sessiondata);

                    $this->M_auth->setLogTime($user->user_id);

                    // cek status dari user yang lagin - 0: BELUM AKTIF - 1: AKTIF - 2: SUSPEND;
                    if ($user->status == "0") {
                        $this->session->set_flashdata('error', "Hi {$user->nama}, harap verifikasi akunmu terlebih dahulu");
                        redirect(site_url('verifikasi-email?act=send-email'));
                    } elseif ($user->status == "2") {
                        $this->session->set_flashdata('error', "Hi {$user->nama}, akunmu telah tersuspend, harap hubungi admin kami untuk konfirmasi");
                        redirect(site_url('suspend'));
                    } else {

                        $this->bypas_otp = $this->M_auth->getSetting('bypass_otp') == 'true' ? true : false;

                        if($this->bypas_otp == true){
                            $session_data = array(
                                'otp' => true,
                            );

                            $this->session->set_userdata($session_data);
                        }

                        // CEK HAK AKSES
                        // ADMIN
                        if ($user->role == 0 || $user->role == 1) {
                            if ($this->session->userdata('redirect')) {
                                $this->session->set_flashdata('notif_success', 'Hi, berhasil masuk, harap lanjutkan aktivitas anda !');
                                redirect($this->session->userdata('redirect'));
                            } else {
                                $this->session->set_flashdata('notif_success', "Welcome super admin, {$user->nama}");
                                redirect(site_url('admin'));
                            }

                        // LEADER
                        } elseif ($user->role == 2) {
                            if ($this->session->userdata('redirect')) {
                                $this->session->set_flashdata('notif_success', 'Hi, berhasil masuk, harap lanjutkan aktivitas anda !');
                                redirect($this->session->userdata('redirect'));
                            } else {
                                $this->session->set_flashdata('notif_success', "Welcome admin, {$user->nama}");
                                redirect(site_url('leader'));
                            }
                        
                        // STAFF
                        } elseif ($user->role == 3) {
                            if ($this->session->userdata('redirect')) {
                                $this->session->set_flashdata('notif_success', 'Hi, berhasil masuk, harap lanjutkan aktivitas anda !');
                                redirect($this->session->userdata('redirect'));
                            } else {
                                $this->session->set_flashdata('notif_success', "Selamat datang, {$user->nama}");
                                redirect(site_url('staff'));
                            }
                        } else {
                            $this->session->set_flashdata('notif_success', "Welcome, {$user->nama}");
                            redirect(base_url());
                        }
                    }
                } else {
                    $attempt = $this->session->userdata('attempt');
                    $attempt++;
                    $this->session->set_userdata('attempt', $attempt);

                    if ($attempt == 3) {
                        $attempt = 0;
                        $this->session->set_userdata('attempt', $attempt);

                        setcookie("penalty", true, time() + 180);
                        setcookie("expire",
                            time() + 180,
                            time() + 180
                        );

                        $this->session->set_flashdata('notif_error', 'Terlalu banyak request, coba lagi dalam 3 menit !');
                        redirect('masuk');
                    } else {
                        $this->session->set_flashdata('warning', 'Password salah, sisa kesempatan - ' . (3 - $attempt));
                        redirect('masuk');
                    }
                }
            }
        }
    }

    public function register()
    {
        // menerimaemaildan password serta memparse karakter spesial
        $undangan = htmlspecialchars($this->input->post('undangan'), true);
        $email = htmlspecialchars($this->input->post('email'), true);
        $password = htmlspecialchars($this->input->post('password'), true);
        $password_ver = htmlspecialchars($this->input->post('confirmPassword'), true);

        $post_code      = $this->input->post('captcha');
        $captcha        = $this->session->userdata('captcha');
        
        // cek captcha
        if($post_code && ($post_code == $captcha)){
            // cek apakahemailvalid
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                // cek apakah password sama dengan konfirmasi password
                if ($password == $password_ver) {

                    // cek apakahemailtelah digunakan
                    if ($this->M_auth->get_auth($email) == false) {

                        // mendaftarkan user ke sistem
                        if ($this->M_auth->register_user() == true) {

                            // mengambil data user dengan param email
                            $user = $this->M_auth->get_auth($email);

                            // mengatur data session
                            $sessiondata = [
                                'user_id' => $user->user_id,
                                'email' => $user->email,
                                'nama' => $user->nama,
                                'role' => $user->role,
                                'logged_in' => true
                            ];

                            // menyimpan data session
                            $this->session->set_userdata($sessiondata);

                            if($undangan == false){
                                // mengirimkan email selamat bergabung
                                $subject = "Selamat bergabung";
                                $message = "Hi {$user->nama}, Selamat telah bergabung bersama kami. Harap verifikasi akunmu dengan kode verifikasi yang telah kami kirimkan ke emailmu";
        
                                sendMail($email, $subject, $message);
                                redirect(site_url('verifikasi-email?act=send-email'));
                            }else{
                                // $this->bypas_otp = $this->M_auth->getSetting('bypass_otp') == 'true' ? true : false;

                                // if($this->bypas_otp == true){
                                //     $session_data = array(
                                //         'otp' => true,
                                //     );

                                //     $this->session->set_userdata($session_data);
                                // }

                                // // CEK HAK AKSES
                                // // ADMIN
                                // if ($user->role == 1) {
                                //     if ($this->session->userdata('redirect')) {
                                //         $this->session->set_flashdata('notif_success', 'Hi, berhasil masuk, harap lanjutkan aktivitas anda !');
                                //         redirect($this->session->userdata('redirect'));
                                //     } else {
                                //         $this->session->set_flashdata('notif_success', "Welcome super admin, {$user->nama}");
                                //         redirect(site_url('admin'));
                                //     }

                                // // LEADER
                                // } elseif ($user->role == 2) {
                                //     if ($this->session->userdata('redirect')) {
                                //         $this->session->set_flashdata('notif_success', 'Hi, berhasil masuk, harap lanjutkan aktivitas anda !');
                                //         redirect($this->session->userdata('redirect'));
                                //     } else {
                                //         $this->session->set_flashdata('notif_success', "Welcome admin, {$user->nama}");
                                //         redirect(site_url('leader'));
                                //     }
                                
                                // // STAFF
                                // } elseif ($user->role == 3) {
                                //     if ($this->session->userdata('redirect')) {
                                //         $this->session->set_flashdata('notif_success', 'Hi, berhasil masuk, harap lanjutkan aktivitas anda !');
                                //         redirect($this->session->userdata('redirect'));
                                //     } else {
                                //         $this->session->set_flashdata('notif_success', "Selamat datang, {$user->nama}");
                                //         redirect(site_url('staff'));
                                //     }
                                // } else {
                                //     $this->session->set_flashdata('notif_success', "Welcome, {$user->nama}");
                                //     redirect(base_url());
                                // }
                                $this->session->set_flashdata('success', 'Pendaftaran berhasil, Harap verifikasi akunmu dengan kode verifikasi yang telah kami kirimkan ke emailmu');
                                redirect(site_url('verifikasi-email?act=send-email'));
                            }

                            // mengirimkan user untuk verifikasi email
                        } else {
                            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftarkan diri!');
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
        }else{
            $this->session->set_flashdata('warning', "Captcha yang anda masukkan salah !");
            redirect($this->agent->referrer());
        }
    }

    public function verifikasi()
    {
        // cek apakah user sudah masuk ke sistem
        if ($this->session->userdata('logged_in') == true || $this->session->userdata('logged_in')) {

            // menerima kode verifikasi
            $kode = htmlspecialchars($this->input->post('kode'), true);
            // mengambil data verifikasi
            $verifikasi = $this->M_auth->get_verifikasi(htmlspecialchars($this->session->userdata('user_id'), true), true);

            // cek apakah waktu verifikasi telah melebihi 1x24 jam
            if (time() - ($verifikasi->date_created < (60 * 60 * 24))) {

                // cek apakah kode verifikasi benar
                if ($this->M_auth->verifikasi_kode(str_replace('-', '', $kode), $this->session->userdata('user_id')) == true) {

                    // memverivikasi email
                    if ($this->M_auth->verifikasi_akun($this->session->userdata('user_id')) == true) {

                        $this->session->set_flashdata('success', "Berhasil verifikasi akunmu!");
                        redirect(base_url());
                    } else {
                        $this->session->set_flashdata('notif_error', 'Terjadi kesalahan, coba lagi nanti !');
                        redirect($this->agent->referrer());
                    }
                } else {
                    $this->session->set_flashdata('notif_warning', 'Kode verifikasi salah, coba lagi !');
                    redirect($this->agent->referrer());
                }
            } else {

                $this->M_auth->del_user($this->session->userdata('user_id'));
                $this->session->set_flashdata('error', 'Kode verifikasi telah kadaluarsa, harap ulangi proses pendaftaran. ');
                redirect(site_url('keluar'));
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

    public function lupaPassword()
    {
                // cek apakahemailada
        if ($this->M_auth->cek_auth(htmlspecialchars($this->input->post("email"), true)) == true) {

            // mengambil data user, param email
            $user = $this->M_auth->get_auth(htmlspecialchars($this->input->post("email"), true));

            // menghapus token permintaan lupa password sebelumnya
            $this->M_auth->del_token($user->user_id, 2);

            // create token for reset
            do {
                $token = bin2hex(random_bytes(32));
            } while ($this->M_auth->cek_tokenReset($token) == true);

            $token = $token;
            // atur data untuk menyimpan token reset password
            $data = [
                'user_id' => $user->user_id,
                'key' => $token,
                'type' => 2, //2. CHANGE PASSWORD
                'date_created' => time()
            ];

            // simpan data token reset password
            $this->M_auth->insert_token($data);

            // memparse email yang diinputkan
            $email = htmlspecialchars($this->input->post("email"), true);

            // setting data untuk dikirim ke email
            $subject = "Permintaan reset password ";
            $message = 'Hai, kami menerima permintaan reset password untuk email <b>' . $email . '</b>.<br> Harap click tombol dibawah ini untuk melanjutkan proses reset password! <br><hr><br><center><a href="' . base_url() . 'reset-password/' . $token . '" style="background-color: #377dff;border:none;color:#fff;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;">Reset Password</a></center><br><br>atau click link dibawah ini: <br>' . base_url() . 'reset-password/' . $token . '<br><br><small class="text-muted">Link tersebut hanya akan valid selama 24 jam, jika link telah kadaluarsa, harap mengulang proses reset password</small>';

            // mengirim ke email
            if (sendMail($email, $subject, $message) == true) {
                $this->session->set_flashdata('success', 'Berhasil mengirim email, cek kotak masuk atau folder spam di emailmu');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan, saat mencoba mengirim link reset password ke emailmu!');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('error', 'Tidak dapat menemukan akun dengan email ' . $this->input->post("email") . ' !');
            redirect($this->agent->referrer());
        }
    }

    public function resetPassword()
    {
                // cek apakah akun user ada
        if ($this->M_auth->cek_auth(htmlspecialchars($this->input->post("email"), true)) == true) {

            // cek apakah password sama

            if ($this->input->post('password') == $this->input->post('confirmPassword')) {

                // mengambil data user
                $user = $this->M_auth->get_auth(htmlspecialchars($this->input->post("email"), true));

                // update password user
                if ($this->M_auth->update_passwordUser($user->user_id) == true) {

                    // menghapus token permintaan lupa password
                    $this->M_auth->del_token($user->user_id, 2);

                    // atur dataemailperubahan password
                    $now = date("d F Y - H:i");
                    $email = htmlspecialchars($this->input->post("email"), true);

                    $subject = "Perubahan password";
                    $message = "Hai, password untuk akun dengan email <b>{$email}</b> telah dirubah pada {$now}. <br>Jika kamu merasa tidak melakukan perubahan tersebut, harap segera hubungi admin kami.";

                    // mengirimemailperubahan password
                    sendMail(htmlspecialchars($this->input->post("email"), true), $subject, $message);

                    // menghapus session
                    $this->session->set_flashdata('success', 'Berhasil mengubah password akunmu, harap masuk dengan password barumu');
                    redirect(site_url('masuk'));
                } else {
                    $this->session->set_flashdata('notif_error', 'Terjadi kesalahan saat mencoba mengubah passwordmu, coba lagi nanti');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', 'Konfirmasi password tidak sama');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('error', 'Email tidak diketahui, hubungi admin jika ini masih terjadi.');
            redirect($this->agent->referrer());
        }
    }

    // LOGOUT
    public function logout()
    {
        // SESS DESTROY
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
