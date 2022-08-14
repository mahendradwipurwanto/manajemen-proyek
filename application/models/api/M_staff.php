<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_staff extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function countStaff(){
        $totalStaff = $this->db->get_where('tb_auth', ['role' => 3])->num_rows();
        $aktifStaff = $this->db->get_where('tb_auth', ['role' => 3, 'status' => 1])->num_rows();
        $idleStaff = $this->db->get_where('tb_auth', ['role' => 3])->num_rows();
        $suspendStaff = $this->db->get_where('tb_auth', ['role' => 3, 'status' => 3])->num_rows();

        return ['totalStaff' => $totalStaff, 'aktifStaff' => $aktifStaff, 'idleStaff' => $idleStaff, 'suspendStaff' => $suspendStaff];
    }

    function getStaff(){
        $this->db->select('a.*, b.*, c.jabatan');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->join('tb_jabatan c', 'b.jabatan_id = c.id', 'left');
        $this->db->where(['a.role' => 3, 'a.status' => 1]);
        return $this->db->get()->result();
    }

    // pendaftaran
    public function tambahStaff()
    {

        // TB AUTH
        $email = htmlspecialchars($this->input->post('email'), true);
        $password = htmlspecialchars($this->input->post('password'), true);

        // TB USER
        $name = htmlspecialchars($this->input->post('nama'), true);
        $jabatan = htmlspecialchars($this->input->post('jabatan'), true);

        // TB AUTH
        $auth = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'status' => 1,
            'role' => 3,
            'created_at' => time()
        ];

        $this->db->insert('tb_auth', $auth);
        $user_id = $this->db->insert_id();

        if ($this->db->affected_rows() == true) {

            $user = [
                'user_id' => $user_id,
                'nama' => $name,
                'jabatan_id' => $jabatan
            ];

            $this->db->insert('tb_user', $user);
            return ($this->db->affected_rows() != 1) ? false : true;
        } else {
            $this->M_auth->del_user($user_id);
            return false;
        }
    }
}
