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
}
