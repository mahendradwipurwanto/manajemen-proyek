<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_leader extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function countLeader(){
        $totalLeader = $this->db->get_where('tb_auth', ['role' => 2])->num_rows();

        $this->db->select('a.id');
        $this->db->from('tb_proyek a');
        $this->db->join('tb_auth b', 'a.created_by = b.user_id');
        $this->db->where(['a.status' => 1, 'a.is_deleted' => 0, 'b.role' => 2]);
        $aktifLeader = $this->db->get()->num_rows();

        $this->db->select('a.created_by');
        $this->db->from('tb_proyek a');
        $this->db->where(['a.status' => 1, 'a.is_deleted' => 0]);
        $proyek = $this->db->get()->result();
        
        $arrId= [];
        foreach ($proyek as $val) {
            $arrId[] = $val->created_by;
        }
        $arrProyekId = implode(",", $arrId);
        $leaderId = explode(",", $arrProyekId);
        $this->db->select("*");
        $this->db->from('tb_auth');
        $this->db->where(['status' => 1, 'role' => 2]);
        $this->db->where_not_in('user_id', $leaderId);

        $idleLeader = $this->db->get()->num_rows();
        
        $suspendLeader = $this->db->get_where('tb_auth', ['role' => 2, 'status' => 3])->num_rows();

        return ['totalLeader' => $totalLeader, 'aktifLeader' => $aktifLeader, 'idleLeader' => $idleLeader, 'suspendLeader' => $suspendLeader];
    }

    function countLeaderDashboard(){
        
        $totalProyek = $this->db->get_where('tb_proyek', ['created_by' => $this->session->userdata('user_id'), 'is_deleted' => 0])->num_rows();
        $totalStaff = $this->db->get_where('tb_assign_staff', ['created_by' => $this->session->userdata('user_id'), 'is_deleted' => 0])->num_rows();
        $totalTask = $this->db->get_where('tb_proyek_task', ['created_by' => $this->session->userdata('user_id'), 'is_deleted' => 0])->num_rows();
        $totalSelesai = $this->db->get_where('tb_proyek', ['created_by' => $this->session->userdata('user_id'), 'is_deleted' => 0, 'is_selesai' => 0])->num_rows();

        return ['totalProyek' => $totalProyek, 'totalStaff' => $totalStaff, 'totalTask' => $totalTask, 'totalSelesai' => $totalSelesai];
    }

    function getLeader(){
        $this->db->select('a.*, b.*, c.jabatan');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->join('tb_jabatan c', 'b.jabatan_id = c.id', 'left');
        $this->db->where(['a.role' => 2, 'a.status' => 1]);
        $models = $this->db->get()->result();

        if(!empty($models)){
            $arr = [];
            foreach($models as $key => $val):
                $arr[$key] = $val;

                $proyekAll = $this->getProyek($val->user_id, 0);
                $proyekAktif = $this->getProyek($val->user_id, 1);
                $proyekArsip = $this->getProyek($val->user_id, 2);
                $arr[$key]->proyek_all = $proyekAll;
                $arr[$key]->proyek_aktif = $proyekAktif;
                $arr[$key]->proyek_arsip = $proyekArsip;
                $arr[$key]->status_proyek = $val->status == 2 ? 3 : ((count($proyekAktif)+count($proyekArsip)) == 0 ? 1 : 2);
            endforeach;
            // ej($arr);
            return $arr;
        }else{
            return $models;
        }
    }

    function getProyek($user_id = null, $status = 1){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where('created_by', $user_id);
        if($status > 0){
        $this->db->where('status', $status);
        }
        return $this->db->get()->result();
    }

    // pendaftaran
    public function tambahLeader()
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
            'role' => 2,
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
