<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_master extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cekUndangan($email)
    {
        return $this->db->get_where('tb_undangan', ['email' => $email])->num_rows();
    }

    function getUndangan($role = 2){
        $this->db->select('*');
        $this->db->from('tb_undangan');
        $this->db->where(['role' => $role]);
        return $this->db->get()->result();
    }

    function undang($role = 3){
        $email = htmlspecialchars($this->input->post('email'), true);

        $jabatan = [
            'email' => $email,
            'role' => $role,
            'created_at' => strtotime(date("Y-m-d")),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_undangan', $jabatan);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function logUndangan($email = null){

        $this->db->where('email', $email);
        $this->db->update('tb_undangan', ['modified_at' => strtotime(date("Y-m-d")), 'modified_by' => $this->session->userdata('user_id')]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getJabatan()
    {
        return $this->db->get_where('tb_jabatan', ['is_deleted' => 0])->result();
    }

    public function simpanJabatan()
    {
        $id = htmlspecialchars($this->input->post('id'), true);
        $jabatan = htmlspecialchars($this->input->post('jabatan'), true);
        $keterangan = htmlspecialchars($this->input->post('keterangan'), true);

        $jabatan = [
            'jabatan' => $jabatan,
            'keterangan' => $keterangan,
            'created_at' => strtotime(date("Y-m-d"))
        ];
        if(isset($id) && $id != ''){
            $this->db->where('id', $id);
            $this->db->update('tb_jabatan', $jabatan);
            return ($this->db->affected_rows() != 1) ? false : true;
        }else{
            $this->db->insert('tb_jabatan', $jabatan);
            return ($this->db->affected_rows() != 1) ? false : true;
        }
    }

    public function hapusJabatan()
    {
        $id = htmlspecialchars($this->input->post('id'), true);

        $this->db->where('id', $id);
        $this->db->update('tb_jabatan', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function updateProfile($picture)
    {
        $name = htmlspecialchars($this->input->post('nama'), true);
        $email = htmlspecialchars($this->input->post('email'), true);
        $phone = htmlspecialchars($this->input->post('no_telp'), true);
        $gender = htmlspecialchars($this->input->post('jk'), true);
        $notifikasi = htmlspecialchars($this->input->post('notifikasi'), true);
        
        $dAuth = [
            'email' => $email,
        ];

        if ($picture == null) {
            $dUser = [
                'nama' => $name,
                'no_telp' => $phone,
                'jk' => $gender,
                'notifikasi' => $notifikasi == 'on' ? 1 : 0
            ];
        } else {
            $dUser = [
                'profil' => $picture,
                'nama' => $name,
                'no_telp' => $phone,
                'jk' => $gender,
                'notifikasi' => $notifikasi == 'on' ? 1 : 0
            ];
        }

        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('tb_auth', $dAuth);

        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('tb_user', $dUser);
        return true;
    }

    function getReminderTask(){
        $this->db->select('tb_proyek_task.*, tb_user.nama, tb_auth.email')
        ->from('tb_proyek_task')
        ->join('tb_proyek_status', 'tb_proyek_task.status_id = tb_proyek_status.id')
        ->join('tb_user', 'tb_proyek_task.user_id = tb_user.user_id')
        ->join('tb_auth', 'tb_proyek_task.user_id = tb_auth.user_id')
        ->where(['tb_proyek_task.is_deleted' => 0, 'tb_proyek_status.is_selesai' => 0, 'tb_proyek_status.is_closed' => 0])
        ;

        $models = $this->db->get()->result();

        return $models;
    }

}