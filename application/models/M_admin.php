<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // global
    function get_settingsValue($key){
        return $this->db->get_where('tb_settings', ['key' => $key])->row()->value;
    }

    function countDashboard(){

        $proyek = $this->db->get_where('tb_proyek', ['is_deleted' => 0])->num_rows();
        $leader = $this->db->get_where('tb_auth', ['role' => 2, 'status' => 1])->num_rows();
        $staff = $this->db->get_where('tb_auth', ['role' => 3, 'status' => 1])->num_rows();
        $tasks = $this->db->get_where('tb_proyek_task', ['is_deleted' => 0])->num_rows();

        return ['proyek' => $proyek, 'leader' => $leader, 'staff' => $staff, 'tasks' => $tasks];
    }

    function get_allAccount(){
        $this->db->select('a.email, a.role, a.status, a.is_deleted, a.log_time, b.*')
        ->from('tb_auth a')
        ->join('tb_user b', 'a.user_id = b.user_id', 'inner')
        ->order_by('a.role ASC')
        ;

        return $this->db->get()->result();
    }

    function get_superAccount(){
        $this->db->select('a.email, a.password, a.log_time, b.*')
        ->from('tb_auth a')
        ->join('tb_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 0])
        ;

        return $this->db->get()->row();
    }

    function get_adminAccount(){
        $this->db->select('a.email, a.log_time, b.*')
        ->from('tb_auth a')
        ->join('tb_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 1])
        ;

        return $this->db->get()->row();
    }

    function get_leaderAccount(){
        $this->db->select('a.email, a.log_time, b.*')
        ->from('tb_auth a')
        ->join('tb_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 2])
        ;

        return $this->db->get()->result();
    }

    function get_staffAccount(){
        $this->db->select('a.email, a.log_time, b.*')
        ->from('tb_auth a')
        ->join('tb_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 2])
        ;

        return $this->db->get()->result();
    }
}
