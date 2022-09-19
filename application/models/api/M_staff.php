<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_staff extends CI_Model
{

    private $table = 'tb_assign_staff';

    public function __construct()
    {
        parent::__construct();

        $this->table = $this->session->userdata('is_leader') == true ? 'tb_assign_leader' : 'tb_assign_staff';
    }

    function countStaff(){
        $totalStaff = $this->db->get_where('tb_auth', ['role' => 3])->num_rows();

        $this->db->select('a.user_id');
        $this->db->from($this->table.' a');
        $this->db->where(['a.status' => 1, 'a.is_deleted' => 0]);
        $assign = $this->db->get()->result();

        $arrId= [];
        foreach ($assign as $val) {
            $arrId[] = $val->user_id;
        }
        $arrAssignId = implode(",", $arrId);
        $staffId = explode(",", $arrAssignId);
        $this->db->select("*");
        $this->db->from('tb_auth');
        $this->db->where(['status' => 1, 'role' => 3]);
        $this->db->where_in('user_id', $staffId);

        $aktifStaff = $this->db->get()->num_rows();

        $this->db->select('a.user_id');
        $this->db->from('tb_proyek_task a');
        $this->db->join('tb_proyek_status b', 'a.status_id = b.id');
        $this->db->where(['b.is_mulai' => 1, 'a.is_deleted' => 0]);
        $tasks = $this->db->get()->result();

        $arrId= [];
        foreach ($tasks as $val) {
            $arrId[] = $val->user_id;
        }
        $arrProyekId = implode(",", $arrId);
        $staffId = explode(",", $arrProyekId);
        $this->db->select("*");
        $this->db->from('tb_auth');
        $this->db->where(['status' => 1, 'role' => 3]);
        $this->db->where_not_in('user_id', $staffId);

        $idleStaff = $this->db->get()->num_rows();

        $suspendStaff = $this->db->get_where('tb_auth', ['role' => 3, 'status' => 3])->num_rows();

        return ['totalStaff' => $totalStaff, 'aktifStaff' => $aktifStaff, 'idleStaff' => $idleStaff, 'suspendStaff' => $suspendStaff];
    }
    function countDashboardStaff(){ 
        $this->db->select('*')
        ->from($this->table.' a')
        ->join('tb_proyek b', 'a.proyek_id = b.id')
        ->where(['a.user_id' => $this->session->userdata('user_id'), 'a.status' => 1, 'b.is_deleted' => 0])
        ;

        $totalProyek = $this->db->get()->num_rows();

        $this->db->select('*')
        ->from('tb_proyek_task a')
        ->join('tb_proyek b', 'a.proyek_id = b.id')
        ->where(['a.user_id' => $this->session->userdata('user_id'), 'a.is_deleted' => 0, 'b.is_deleted' => 0])
        ;

        $totalTask = $this->db->get()->num_rows();

        $this->db->select('*')
        ->from('tb_proyek_task a')
        ->join('tb_proyek b', 'a.proyek_id = b.id')
        ->where(['a.user_id' => $this->session->userdata('user_id'), 'a.is_selesai' => 0, 'a.is_closed' => 0, 'a.is_deleted' => 0, 'b.is_deleted' => 0])
        ;

        $taskProses = $this->db->get()->num_rows();

        $this->db->select('*')
        ->from('tb_proyek_task a')
        ->join('tb_proyek b', 'a.proyek_id = b.id')
        ->where(['a.user_id' => $this->session->userdata('user_id'), 'a.is_selesai' => 1, 'a.is_closed' => 1, 'a.is_deleted' => 0, 'b.is_deleted' => 0])
        ;

        $taskSelesai = $this->db->get()->num_rows();

        return ['totalProyek' => $totalProyek, 'totalTask' => $totalTask, 'taskProses' => $taskProses, 'taskSelesai' => $taskSelesai];
    }

    function getStaff(){
        $this->db->select('a.*, b.*, c.jabatan');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->join('tb_jabatan c', 'b.jabatan_id = c.id', 'left');
        $this->db->where(['a.role' => 3, 'a.status' => 1]);
        $models = $this->db->get()->result();

        if(!empty($models)){
            $arr = [];
            foreach($models as $key => $val):
                $arr[$key] = $val;

                $proyekAll = $this->getAssign($val->user_id, 1);
                $proyekAktif = $this->getAssign($val->user_id, 1);
                $proyekArsip = $this->getAssign($val->user_id, 2);
                $arr[$key]->proyek_all = $proyekAll;
                $arr[$key]->proyek_aktif = $proyekAktif;
                $arr[$key]->proyek_arsip = $proyekArsip;
                $arr[$key]->leader = $this->getStaffLeader($val->user_id);
                $arr[$key]->status_staff = $this->cekStaffIdle($val->user_id, 0)['status'] == true ? 1 : 0;
                $arr[$key]->total_task = $this->cekStaffIdle($val->user_id, 1)['total_tasks'];
                $arr[$key]->tasks = $this->cekStaffIdle($val->user_id, 1)['tasks'];
            endforeach;
            
            return $arr;
        }else{
            return $models;
        }
    }

    function getStaffLeader($user_id){
        $this->db->select('*')
        ->from('tb_assign_leader a')
        ->join('tb_proyek b', 'a.proyek_id = b.id', 'inner')
        ->where(['a.user_id' => $user_id, 'b.status' => 1, 'b.is_deleted' => 0])
        ;

        return $this->db->get()->result();
    }

    function getAssign($user_id = null, $status = 1){
        $this->db->select('a.id, b.*');
        $this->db->from($this->table.' a');
        $this->db->join('tb_proyek b', 'a.proyek_id = b.id');
        $this->db->where('a.user_id', $user_id);
        if($status > 0){
        $this->db->where('a.status', $status);
        }
        return $this->db->get()->result();
    }



    function cekStaffIdle($staff_id, $type = 0)
    {
        $this->db->select('a.*, b.*');
        $this->db->from('tb_proyek_task a');
        $this->db->join('tb_proyek_status b', 'a.status_id = b.id');
        $this->db->join('tb_proyek c', 'a.proyek_id = c.id');
        if($type == 1){
            $this->db->where(['c.is_deleted' => 0, 'a.is_deleted' => 0, 'b.is_deleted' => 0, 'a.user_id' => $staff_id]);
        }else{
            $this->db->where(['b.is_mulai' => 0, 'b.is_selesai' => 0, 'c.is_deleted' => 0, 'a.is_deleted' => 0, 'b.is_deleted' => 0, 'a.user_id' => $staff_id]);
        }
        $tasks = $this->db->get();

        if ($tasks->num_rows() > 0) {
            return [
                'status' => false,
                'tasks' => $tasks->result(),
                'total_tasks' => $tasks->num_rows()
            ];
        } else {
            return [
                'status' => true,
                'tasks' => $tasks->result(),
                'total_tasks' => $tasks->num_rows()
            ];
        }
    }


    function getProyekStaffAll($status, $periode = []){

        $this->db->select('a.id, a.user_id, a.proyek_id, b.*');
        $this->db->from('tb_assign_staff a');
        $this->db->join('tb_proyek b', 'a.proyek_id = b.id');
        $this->db->where(['b.status' => $status, 'b.is_deleted' => 0]);
        if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3){
            $this->db->where('a.user_id', $this->session->userdata('user_id'));
        }

        if(!empty($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['b.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['b.created_at >=' => strtotime($periode[0]), 'b.created_at <=' => strtotime($periode[1])]);
            }
        }
        $this->db->order_by('created_at DESC');
        $proyek = $this->db->get()->result();

        $arr = [];
        foreach($proyek as $key => $val):
            $arr[$key] = $val;
            $arr[$key]->progress = $this->getProgressProyek($val->id);
            $arr[$key]->is_leader = $this->cekIfLeaderProyek($val->user_id, $val->proyek_id)['status'] == true ? true : false;
            $arr[$key]->leader = $this->getLeaderProyek($val->id, 1);
            $arr[$key]->staff = $this->getStaffProyek($val->id, 1);
            $arr[$key]->staff_free = $this->getStaffProyek($val->id, 0);
        endforeach;

        $this->db->select('a.id, a.user_id, a.proyek_id, b.*');
        $this->db->from('tb_assign_leader a');
        $this->db->join('tb_proyek b', 'a.proyek_id = b.id');
        $this->db->where(['b.status' => $status, 'b.is_deleted' => 0]);
        if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3){
            $this->db->where('a.user_id', $this->session->userdata('user_id'));
        }

        if(!empty($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['b.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['b.created_at >=' => strtotime($periode[0]), 'b.created_at <=' => strtotime($periode[1])]);
            }
        }
        $this->db->order_by('created_at DESC');
        $proyek_staff = $this->db->get()->result();

        $arrStaff = [];
        foreach($proyek_staff as $key => $val):
            $arrStaff[$key] = $val;
            $arrStaff[$key]->progress = $this->getProgressProyek($val->id);
            $arrStaff[$key]->is_leader = $this->cekIfLeaderProyek($val->user_id, $val->proyek_id)['status'] == true ? true : false;
            $arrStaff[$key]->leader = $this->getLeaderProyek($val->id, 1);
            $arrStaff[$key]->staff = $this->getStaffProyek($val->id, 1);
            $arrStaff[$key]->staff_free = $this->getStaffProyek($val->id, 0);
        endforeach;

        return array_merge($arr, $arrStaff);
    }

    function getProgressProyek($id){
        $this->db->select('*')
        ->from('tb_proyek_task')
        ->where(['is_deleted' => 0, 'proyek_id' => $id])
        ;

        $taskTotal = $this->db->get()->num_rows();
        
        $this->db->select('*')
        ->from('tb_proyek_task')
        ->where(['is_closed' => 1, 'is_deleted' => 0, 'proyek_id' => $id])
        ;

        $taskSelesai = $this->db->get()->num_rows();
        // ej($taskTotal);

        if($taskTotal > 0 && $taskSelesai > 0){
            return (($taskSelesai/$taskTotal)*100);
        }else{
            return 0;
        }
    }

    function getLeaderProyek($id, $status){
        
        $this->db->select('a.*, b.profil, b.nama, b.jabatan_id, c.jabatan')
        ->from('tb_assign_leader a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->join('tb_jabatan c', 'b.jabatan_id = c.id', 'left')
        ->where(['a.proyek_id' => $id, 'a.status' => 1, 'a.is_deleted' => 0]);

        if($status == 0){
            $models = $this->db->get()->result();
            
            $arrId = [];
            foreach($models as $key => $val){
                $arrId[] = $val->user_id;
            }
            $arrStaffId = implode(",", $arrId);
            $staffId = explode(",", $arrStaffId);

            $this->db->select('*')
            ->from('tb_user a')
            ->join('tb_auth b', 'a.user_id = b.user_id')
            ->where(['b.is_deleted' => 0, 'b.role' => 3, 'b.status' => 1]);
            
            $this->db->where_not_in('a.user_id', $staffId);
        }

        $models = $this->db->get()->result();
        
        $arr = [];
        foreach($models as $key => $val){
            $arr[$key] = $val;
            if($status == 1){
                $arr[$key]->task = $this->getTaskStaff($val->proyek_id, $val->user_id, 0, 0); #all
                $arr[$key]->task_proses = $this->getTaskStaff($val->proyek_id, $val->user_id, 1, 0); #proses
                $arr[$key]->task_selesai = $this->getTaskStaff($val->proyek_id, $val->user_id, 0, 1); #selesai
            }
        }
        
        return $arr;
    }

    function getStaffProyek($id, $status)
    {
        $this->db->select('a.*, b.profil, b.nama, b.jabatan_id, c.jabatan')
        ->from('tb_assign_staff a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->join('tb_jabatan c', 'b.jabatan_id = c.id', 'left')
        ->where(['a.proyek_id' => $id, 'a.status' => 1, 'a.is_deleted' => 0]);

        if ($status == 0) {
            $models = $this->db->get()->result();

            $arrId = [];
            foreach ($models as $key => $val) {
                $arrId[] = $val->user_id;
            }
            $arrStaffId = implode(",", $arrId);
            $staffId = explode(",", $arrStaffId);

            $this->db->select('*')
            ->from('tb_user a')
            ->join('tb_auth b', 'a.user_id = b.user_id')
            ->where(['b.is_deleted' => 0, 'b.role' => 3, 'b.status' => 1]);

            $this->db->where_not_in('a.user_id', $staffId);
        }

        $models = $this->db->get()->result();

        $arr = [];
        foreach ($models as $key => $val) {
            $arr[$key] = $val;
            if ($status == 1) {
                $arr[$key]->task = $this->getTaskStaff($val->proyek_id, $val->user_id, 0, 0); #all
                $arr[$key]->task_proses = $this->getTaskStaff($val->proyek_id, $val->user_id, 1, 0); #proses
                $arr[$key]->task_selesai = $this->getTaskStaff($val->proyek_id, $val->user_id, 0, 1); #selesai
            }
        }

        return $arr;
    }

    function getTaskStaff($proyek_id = null, $user_id = null, $is_proses = 0, $is_selesai = 0){
        $this->db->select('a.*, b.status, b.warna, b.is_mulai, b.is_selesai as status_selesai')
        ->from('tb_proyek_task a')
        ->join('tb_proyek_status b', 'a.status_id = b.id')
        ->where(['a.proyek_id' => $proyek_id, 'a.user_id' => $user_id, 'a.is_deleted' => 0]);
        if($is_proses == 1){
            $this->db->where(['is_mulai' => 0, 'b.is_selesai' => 0]);
        }

        if($is_selesai == 1){
            $this->db->where(['is_mulai' => 0, 'b.is_selesai' => 1]);
        }
        $models = $this->db->get()->result();

        foreach ($models as $key => $val) {
            if($val->bobot >= 80){ #success
                $color = 'soft-success';
            }elseif($val->bobot >= 50){ #primary
                $color = 'soft-primary';
            }elseif($val->bobot >= 30){ #warning
                $color = 'soft-warning';
            }else{ #secondary
                $color = 'soft-secondary';
            }
            $val->bobot_color = $color;
            $val->dibuat_pada = date("d M Y", $val->created_at);
            $val->diubah_pada = $val->modified_at == 0 ? '-' : date("d M Y", $val->modified_at);
        }

        return [
            'list' => $models,
            'total' => count($models)
        ];
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

    public function cekIfLeaderProyek($user_id = 0, $proyek_id = 0){
        $this->db->select('*')
        ->from('tb_assign_leader')
        ->where(['user_id' => $user_id, 'proyek_id' => $proyek_id]);

        $models = $this->db->get()->result();

        if(count($models) > 0){
            return [
                'status' => true,
                'data' => $models
            ];
        }else{
            return [
                'status' => false,
                'data' => null
            ];
        }
    }
}
