<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_proyek extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insert_log($proyek_id, $message = null){
        $data = [
            'proyek_id' => $proyek_id,
            'user_id' => $this->session->userdata('user_id'),
            'message' => $message == null ? 'Mengelola proyek' : $message,
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];
        
        $this->db->insert('log_proyek', $data);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
    }

    function insert_logNotif($proyek_id, $message = null){
        $data = [
            'proyek_id' => $proyek_id,
            'user_id' => $this->session->userdata('user_id'),
            'message' => $message == null ? 'Mengelola proyek' : $message,
            'is_notif' => 1,
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];
        
        $this->db->insert('log_proyek', $data);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
    }
    
    function getProyekById($proyek_id = null){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where(['id' => $proyek_id]);
        $this->db->order_by('created_at DESC');
        $models = $this->db->get()->row();

        $models->upload_type = json_decode($models->upload_type);

        $models->upload_allowed = '';
        $models->upload_string = '';
        if (!empty($models->upload_type)) {
            foreach ($models->upload_type as $k => $v) {
                $models->upload_allowed .= $k.", ";
                $models->upload_string .= $v.", ";
            }
        }
        
        $models->file_pendukung = [];
        $models->file_pendukung = $this->getPendukungProyek($models->id);

        return $models;

    }
    
    function getAllProyek(){
        return $this->db->get_where('tb_proyek', ['is_deleted' => 0])->result();
    }
    
    function getAllProyekStaff(){
        $this->db->select('a.*');
        $this->db->from('tb_proyek a');
        $this->db->join('tb_assign_staff b', 'a.id = b.proyek_id');
        $this->db->where(['a.is_deleted' => 0, 'b.user_id' => $this->session->userdata('user_id')]);
        return $this->db->get()->result();
    }

    function getLogProyek($proyek_id = 0){
        $this->db->select('a.*, b.nama, c.judul');
        $this->db->from('log_proyek a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->join('tb_proyek c', 'a.proyek_id = c.id');
        $this->db->where(['a.is_deleted' => 0, 'a.is_notif' => 0]);

        if($proyek_id > 0){
            $this->db->where('a.proyek_id', $proyek_id);
        }

        $this->db->order_by('a.created_at DESC');
        $this->db->limit(25);
        $models = $this->db->get()->result();

        foreach($models as $key => $val){
            $nama = explode(" ", $val->nama);
            $val->nama = $nama[0];
            if(!strpos($val->message, $val->judul)){
                $val->message .= " <b>{$val->judul}</b>";
            }
            $val->created_at = time_ago(date('Y-m-d H:i:s', $val->created_at));
        }

        return $models;
    }

    function getLogProyekStaff($proyek_id = 0)
    {
        $this->db->select('a.*, b.nama, c.judul');
        $this->db->from('log_proyek a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->join('tb_proyek c', 'a.proyek_id = c.id');
        $this->db->where(['a.is_deleted' => 0, 'a.is_notif' => 0]);
        
        if ($proyek_id > 0) {
            $this->db->where('a.proyek_id', $proyek_id);
        }

        $this->db->order_by('a.created_at DESC');
        $this->db->limit(25);
        $models = $this->db->get()->result();

        foreach ($models as $key => $val) {
            $nama = explode(" ", $val->nama);
            $val->nama = $nama[0];
            if (!strpos($val->message, $val->judul)) {
                $val->message .= " <b>{$val->judul}</b>";
            }
            $val->created_at = time_ago(date('Y-m-d H:i:s', $val->created_at));
        }

        return $models;
    }

    function getNotifikasiStaff($proyek_id = 0)
    {
        $this->db->select('a.*, b.nama, c.judul');
        $this->db->from('log_proyek a');
        $this->db->join('tb_user b', 'a.staff_id = b.user_id');
        $this->db->join('tb_proyek c', 'a.proyek_id = c.id');
        $this->db->where(['a.is_deleted' => 0, 'a.staff_id' => $this->session->userdata('user_id'), 'a.is_notif' => 1]);

        if ($proyek_id > 0) {
            $this->db->where('a.proyek_id', $proyek_id);
        }

        $this->db->order_by('a.created_at DESC');
        $this->db->limit(25);
        $models = $this->db->get()->result();

        foreach ($models as $key => $val) {
            $nama = explode(" ", $val->nama);
            $val->nama = $nama[0];
            if (!strpos($val->message, $val->judul)) {
                $val->message .= " <b>{$val->judul}</b>";
            }
            $val->created_at = time_ago(date('Y-m-d H:i:s', $val->created_at));
        }

        return $models;
    }



    function getChartKPI($periode = [], $proyek_id = null){
        $data = $this->getDataKPI($periode, $proyek_id);

        $arr = [];
        if(!empty($data)){
            foreach($data as $key => $val){
                $arr['kategori'][] = "'{$val->nama}'";
                $arr['data'][] = $val->persentase;
            }
        }

        return $arr;
    }

    function getDataKPI($periode = [], $proyek_id = null){
        // get data staff
        $this->db->select('b.*, d.jabatan, c.proyek_id')
        ->from('tb_auth a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->join('tb_assign_staff c', 'a.user_id = c.user_id')
        ->join('tb_jabatan d', 'b.jabatan_id = d.id', 'left')
        ->join('tb_assign_leader e', 'a.user_id = e.user_id', 'left')
        ->where(['a.role' => 3, 'a.status' => 1, 'a.is_deleted' => 0, 'c.status' => 1])
        ->group_by('a.user_id');
        ;

        if(!empty($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['c.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['c.created_at >=' => strtotime($periode[0]), 'c.created_at <=' => strtotime($periode[1])]);
            }
        }

        if(!is_null($proyek_id)){
            $this->db->where(['c.proyek_id' => $proyek_id]);
        }

        $staff = $this->db->get()->result();
        
        $arrKpi = [];
        foreach($staff as $key => $val){
            $arrKpi[$key] = $val;
            if(isset($val->proyek_id)){
                $arrKpi[$key]->proyek = $this->getProyekStaff($val->proyek_id);
                $arrKpi[$key]->totalProyek = count($this->getProyekStaff($val->proyek_id));

                $arrKpi[$key]->task = $this->getTaskStaffKpi($proyek_id, $val->user_id);
                $arrKpi[$key]->totalTask = count($this->getTaskStaffKpi($proyek_id, $val->user_id, 0));
                $arrKpi[$key]->taskSelesai = count($this->getTaskStaffKpi($proyek_id, $val->user_id, 1));
                $arrKpi[$key]->taskSelesaiData = $this->getTaskStaffKpi($proyek_id, $val->user_id, 1);
                $arrKpi[$key]->taskProses = count($this->getTaskStaffKpi($proyek_id, $val->user_id, 2));
                $arrKpi[$key]->taskProsesData = $this->getTaskStaffKpi($proyek_id, $val->user_id, 2);

                // hitung total bobot
                $total_bobot = 0;
                foreach ($this->getTaskStaffKpi($proyek_id, $val->user_id) as $k => $v) {
                    $total_bobot += $v->bobot;
                }
                // hitung nilai
                $nilai = 0;
                $presentase = 0;
                $rumus = [];
                foreach ($this->getTaskStaffKpi($proyek_id, $val->user_id) as $k => $v) {
                    if($v->is_selesai == 1 || $v->is_closed == 1){
                        $nilai += (($v->bobot/$total_bobot)*(($total_bobot*3)/4));
                        $presentase += round(($v->bobot/$total_bobot)*100);
                        $index_kpi = ($total_bobot*3)/4;

                        $rumus['nilai'][] = "{$v->bobot}/{$total_bobot}*100= {$nilai}";
                        $rumus['presentase'][] = "{$v->bobot}/{$total_bobot}*{$index_kpi}= {$presentase}%";
                    }
                }
                $arrKpi[$key]->nilai = $nilai;
                $arrKpi[$key]->persentase = $presentase;
                $arrKpi[$key]->total_bobot = $total_bobot;
                $arrKpi[$key]->rumus = $rumus;

                // $arrKpi[$key]->nilai = $arrKpi[$key]->totalTask > 0 && $arrKpi[$key]->taskSelesai > 0 ? number_format((float)($arrKpi[$key]->taskSelesai/$arrKpi[$key]->totalTask)*10, 1, '.', '') : 0;
                // $arrKpi[$key]->persentase = $arrKpi[$key]->totalTask > 0 && $arrKpi[$key]->taskSelesai > 0 ? number_format((float)(($arrKpi[$key]->taskSelesai/$arrKpi[$key]->totalTask)*100), 2, '.', '') : 0;
            }else{
                $arrKpi[$key]->proyek = [];
                $arrKpi[$key]->totalProyek = 0;

                $arrKpi[$key]->task = [];
                $arrKpi[$key]->totalTask = 0;
                $arrKpi[$key]->taskSelesai = 0;
                $arrKpi[$key]->taskSelesaiData = [];
                $arrKpi[$key]->taskProses = 0;
                $arrKpi[$key]->taskProsesData = [];

                $arrKpi[$key]->nilai = 0;
                $arrKpi[$key]->persentase = 0;
            }
            if($arrKpi[$key]->persentase > 100){
                $color = 'success';
            }elseif($arrKpi[$key]->persentase >= 75 ){
                $color = 'primary';
            }elseif($arrKpi[$key]->persentase >= 50){
                $color = 'info';
            }elseif($arrKpi[$key]->persentase >= 25){
                $color = 'warning';
            }elseif($arrKpi[$key]->persentase > 0){
                $color = 'secondary';
            }else{
                $color = 'danger';
            }

            $arrKpi[$key]->color_badge = $color;
        }
        
        $tempData = array_column($arrKpi, 'persentase');
        array_multisort($tempData, SORT_DESC, $arrKpi);
        // ej($arrKpi);
        return $arrKpi;
    }

    function getProyekStaff($proyek_id = null){
        $this->db->select('*')
        ->from('tb_proyek')
        ->where(['id' => $proyek_id, 'is_deleted' => 0])
        ;

        return $this->db->get()->result();
    }

    function getTaskStaffKpi($proyek_id = null, $user_id = null, $is_selesai = 0){
        $this->db->select('*')
        ->from('tb_proyek_task a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->where(['a.user_id' => $user_id, 'a.is_deleted' => 0])
        ;

        if(!is_null($proyek_id)){
            $this->db->where(['proyek_id' => $proyek_id]);
        }

        if($is_selesai == 1){
            $this->db->where(['is_closed' => 1]);
            $this->db->or_where(['is_selesai' => 1]);
        }elseif($is_selesai == 2){
            $this->db->where(['is_closed' => 0]);
            $this->db->where(['is_selesai' => 0]);
        }

        return $this->db->get()->result();
    }

    function sisaBobotProyek($proyek_id){
        $this->db->select('sum(bobot) as quota_bobot')
        ->From('tb_proyek_task')
        ->where(['proyek_id' => $proyek_id, 'is_deleted' => 0])
        ;

        $models = $this->db->get()->row();
        return $models;
    }

    function getLogProyekLeader(){
        $this->db->select('a.*, b.nama');
        $this->db->from('log_proyek a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->join('tb_proyek c', 'a.proyek_id = c.id', 'left');
        $this->db->where(['c.created_by' => $this->session->userdata('user_id'), 'a.is_deleted' => 0, 'a.is_notif' => 0]);
        $this->db->order_by('a.created_at DESC');
        $this->db->limit(10);
        $models = $this->db->get()->result();

        foreach($models as $key => $val){
            $nama = explode(" ", $val->nama);
            $val->nama = $nama[0];
            $val->created_at = time_ago(date('Y-m-d H:i:s', $val->created_at));
        }

        return $models;
    }

    function getAll(){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where(['is_deleted' => 0]);
        if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3){
            $this->db->where('created_by', $this->session->userdata('user_id'));
        }
        $this->db->order_by('created_at DESC');
        return $this->db->get()->result();
    }

    function getProyekId($kode){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where('kode', $kode);;
        return $this->db->get()->row()->id;
    }

    function getProyekDetail($proyek_id){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where('id', $proyek_id);;
        return $this->db->get()->row();
    }

    function getAllStatus($status = 0, $periode = []){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where(['is_selesai' => $status, 'is_deleted' => 0]);
        // if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3){
        //     $this->db->where('created_by', $this->session->userdata('user_id'));
        // }

        if(!empty($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['created_at >=' => strtotime($periode[0]), 'created_at <=' => strtotime($periode[1])]);
            }
        }
        $this->db->order_by('created_at DESC');
        $proyek = $this->db->get()->result();

        $arr = [];
        foreach($proyek as $key => $val):
            $val->upload_type = json_decode($val->upload_type);
            
            $val->upload_allowed = '';
            $val->upload_string = '';
            if(!empty($val->upload_type)){
                foreach($val->upload_type as $k => $v){
                    $val->upload_allowed .= $k.", ";
                    $val->upload_string .= $v.", ";
                }
            }

            $arr[$key] = $val;
            $arr[$key]->progress = $this->getProgressProyek($val->id);
            $arr[$key]->leader = $this->getLeaderProyek($val->id, 1);
            $arr[$key]->staff = $this->getStaffProyek($val->id, 1);
            $arr[$key]->staff_free = $this->getStaffProyek($val->id, 0);
        endforeach;

        return $arr;
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

    function getStaffProyek($id, $status){
        
        $this->db->select('a.*, b.profil, b.nama, b.jabatan_id, c.jabatan')
        ->from('tb_assign_staff a')
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

    function getTaskStaff($proyek_id = null, $user_id = null, $is_proses = 0, $is_selesai = 0){
        $this->db->select('a.*, b.status, b.warna, b.is_mulai, b.is_selesai as status_selesai')
        ->from('tb_proyek_task a')
        ->join('tb_proyek_status b', 'a.status_id = b.id')
        ->where(['a.proyek_id' => $proyek_id, 'a.user_id' => $user_id, 'a.is_deleted' => 0, 'b.is_deleted' => 0]);
        if($is_proses == 1){
            $this->db->where(['is_mulai' => 0, 'b.is_selesai' => 0]);
        }

        if($is_selesai == 1){
            // $this->db->where(['is_mulai' => 0, 'b.is_selesai' => 1]);
            $this->db->where(['is_mulai' => 0]);
            $this->db->where("a.is_closed = 1");
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

    function getProyekTask($proyek_id){
        $this->db->select('*')
        ->from('tb_proyek_status')
        ->where(['proyek_id' => $proyek_id, 'is_deleted' => 0])
        ->order_by('urutan ASC')
        ;

        $status = $this->db->get()->result();

        $arr = [];
        foreach($status as $key => $val){
            $arr[$key] = $val;
            $arr[$key]->tasks = $this->getTaskByProyekStatus($val->proyek_id, $val->id);
        }

        return $arr;
    }

    function getTaskById($task_id){
        $this->db->select('*')
        ->from('tb_proyek_task')
        ->where(['id' => $task_id, 'is_deleted' => 0])
        ;

        $models = $this->db->get()->row();

        $models->bukti_task = $this->getTaskBukti($task_id);

        return $models;
    }

    function getTaskByProyekStatus($proyek_id, $status_id){

        $this->db->select('a.*, b.judul, c.nama, c.profil, d.jabatan')
        ->from('tb_proyek_task a')
        ->join('tb_proyek b', 'a.proyek_id = b.id')
        ->join('tb_user c', 'a.user_id = c.user_id')
        ->join('tb_jabatan d', 'c.jabatan_id = d.id', 'left')
        ->where(['a.proyek_id' => $proyek_id, 'status_id' => $status_id])
        ->order_by('a.created_at DESC')
        ;

        $models = $this->db->get()->result();

        foreach ($models as $key => $val) {
            if($val->bobot >= 75){ #success
                $color = 'soft-success';
            }elseif($val->bobot >= 50){ #primary
                $color = 'soft-primary';
            }elseif($val->bobot >= 25){ #warning
                $color = 'soft-warning';
            }else{ #secondary
                $color = 'soft-secondary';
            }
            $val->bobot_color = $color;
            $val->dibuat_pada = date("d M Y", $val->created_at);
            $val->deadline_tgl = date("d M Y", $val->deadline);
            $val->deadline = date("Y-m-d", $val->deadline);
            $val->diubah_pada = $val->modified_at == 0 ? '-' : date("d M Y", $val->modified_at);
            $val->bukti_task = $this->getTaskBukti($val->id);
        }

        return $models;
    }

    function getAllStatusStaff($status = 1, $archived = 0){

        $this->db->select('a.proyek_id');
        $this->db->from('tb_assign_staff a');
        $this->db->where(['a.user_id' => $this->session->userdata('user_id'), 'a.status' => 1, 'a.is_deleted' => 0]);
        $proyek = $this->db->get()->result();
        
        $arrId= [];
        foreach ($proyek as $val) {
            $arrId[] = $val->proyek_id;
        }
        $arrProyekId = implode(",", $arrId);
        $staffId = explode(",", $arrProyekId);
        
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where(['status' => $status, 'is_deleted' => 0]);
        $this->db->where_in('id', $staffId);
        $this->db->order_by('created_at DESC');
        return $this->db->get()->result();
    }

    function getDetail($kode = null){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where(['kode' => $kode]);
        $this->db->order_by('created_at DESC');
        $models = $this->db->get()->row();

        $models->upload_type = json_decode($models->upload_type);
        
        $models->upload_allowed = '';
        $models->upload_string = '';
        if(!empty($models->upload_type)){
            foreach($models->upload_type as $k => $v){
                $models->upload_allowed .= $k.", ";
                $models->upload_string .= $v.", ";
            }
        }
        $models->file_pendukung = [];
        $models->file_pendukung = $this->getPendukungProyek($models->id);

        return $models;
    }

    function getPendukungProyek($proyek_id){
        $this->db->select('*')
        ->from('tb_proyek_file')
        ->where(['proyek_id' => $proyek_id, 'is_deleted' => 0])
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    function getProyekStatus($kode = null, $use = 0){

        $idProyek = $this->getDetail($kode);

        $this->db->select('*');
        $this->db->from('tb_proyek_status');
        $this->db->where(['proyek_id' => $idProyek->id, 'is_deleted' => 0]);
        if($use == 1){
            $this->db->where(['is_selesai' => 0, 'is_closed' => 0]);
        }
        $this->db->order_by('urutan ASC');
        return $this->db->get()->result();
    }

    function cekKodeProyek($kode){
        
        if($this->db->get_where('tb_proyek', ['kode' => $kode])->num_rows() == 0){
            return true;
        }else{
            return false;
        }
    }

    function save($file_pendukung = null){

        if($file_pendukung == null){
            $data = [
                'kode' => strtolower($this->input->post('kode')),
                'judul' => $this->input->post('judul'),
                'periode_mulai' => strtotime($this->input->post('periode_mulai')),
                'periode_selesai' => strtotime($this->input->post('periode_selesai')),
                'upload_type' => $this->input->post('upload_type') != null ? json_encode($this->input->post('upload_type')) : json_encode('{"pdf": "application/pdf"}'),
                'keterangan' => $this->input->post('keterangan'),
                'created_at' => strtotime(date("Y-m-d")),
                'created_by' => $this->session->userdata('user_id')
            ];
        }else{
            $data = [
                'kode' => strtolower($this->input->post('kode')),
                'judul' => $this->input->post('judul'),
                'file_pendukung' => $file_pendukung,
                'periode_mulai' => strtotime($this->input->post('periode_mulai')),
                'periode_selesai' => strtotime($this->input->post('periode_selesai')),
                'upload_type' => $this->input->post('upload_type') != null ? json_encode($this->input->post('upload_type')) : json_encode('{"pdf": "application/pdf"}'),
                'keterangan' => $this->input->post('keterangan'),
                'created_at' => strtotime(date("Y-m-d")),
                'created_by' => $this->session->userdata('user_id')
            ];
        }

        $this->db->insert('tb_proyek', $data);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
        
        if($cek == true){
            $proyek_id = $this->db->insert_id();
            $this->insertDefaultStatus($proyek_id);
            $this->insertLeaderProyek($this->input->post('leader'), $proyek_id);
            $this->insertStaffProyek($this->input->post('staff'), $proyek_id);
            return true;
        }else{
            return false;
        }
    }

    function edit($file_pendukung = null){

        if($file_pendukung == null){
            $data = [
                'judul' => $this->input->post('judul'),
                'periode_mulai' => strtotime($this->input->post('periode_mulai')),
                'periode_selesai' => strtotime($this->input->post('periode_selesai')),
                'upload_type' => $this->input->post('upload_type') != null ? json_encode($this->input->post('upload_type')) : json_encode('{"pdf": "application/pdf"}'),
                'keterangan' => $this->input->post('keterangan'),
                'is_selesai' => $this->input->post('is_selesai') == 'on' ? 1 : 0,
                'modified_at' => strtotime(date("Y-m-d")),
                'modified_by' => $this->session->userdata('user_id')
            ];
        }else{
            $data = [
                'judul' => $this->input->post('judul'),
                'periode_mulai' => strtotime($this->input->post('periode_mulai')),
                'periode_selesai' => strtotime($this->input->post('periode_selesai')),
                'upload_type' => $this->input->post('upload_type') != null ? json_encode($this->input->post('upload_type')) : json_encode('{"pdf": "application/pdf"}'),
                'keterangan' => $this->input->post('keterangan'),
                'is_selesai' => $this->input->post('is_selesai') == 'on' ? 1 : 0,
                'modified_at' => strtotime(date("Y-m-d")),
                'modified_by' => $this->session->userdata('user_id')
            ];
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_proyek', $data);

        $cek = ($this->db->affected_rows() != 1) ? false : true;

        if($this->input->post('is_selesai') == 'on'){
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tb_proyek', ['status' => 2]);
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tb_proyek', ['status' => 1]);

            
            $this->db->where('proyek_id', $this->input->post('id'));
            $this->db->update('tb_kpi_manual', ['is_deleted' => 1]);
        }

        return $cek;
    }

    function hapus($proyek_id){
        $data = [
            'is_deleted' => 1,
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $proyek_id);
        $this->db->update('tb_proyek', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function tutup(){
        $data = [
            'is_selesai' => 1,
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_proyek', $data);
        $cek = ($this->db->affected_rows() != 1) ? false : true;

        if($cek == true){
            $dataLeader = [
                'staff_id' => $this->input->post('leader_id'),
                'proyek_id' => $this->input->post('id'),
                'nilai' => $this->input->post('nilai_leader')
            ];

            $this->db->insert('tb_kpi_manual', $dataLeader);

            foreach($this->input->post('staff_id') as $key => $val){
                $dataLeader = [
                    'staff_id' => $this->input->post('staff_id')[$key],
                    'proyek_id' => $this->input->post('id'),
                    'nilai' => $this->input->post('nilai')[$key]
                ];
    
                $this->db->insert('tb_kpi_manual', $dataLeader);
            }

            return true;
        }else{
            return false;
        }
    }

    function cekAssignStaff($status, $user_id = null){
        if($user_id == null){
            $user_id = $this->input->post('staff_id');
        }
        return $this->db->get_where('tb_assign_staff', ['proyek_id' => $this->input->post('proyek_id'), 'user_id' => $user_id, 'status' => $status])->num_rows();
    }

    function assignStaff(){

        if($this->cekAssignStaff(0) == 1 || $this->cekAssignStaff(2) == 1){
            $this->db->where(['proyek_id' => $this->input->post('proyek_id'), 'user_id' => $this->input->post('staff_id')]);
            $this->db->update('tb_assign_staff', ['status' => 1]);
        }else{
            
            $proyek = $this->getProyekDetail($this->input->post('proyek_id'));
            $staff = $this->getStaffDetail($this->input->post('staff_id'));
            // email
            $subject = "Proyek Baru";
            $message = 'Hi '.$staff->nama.', kamu telah ditambahkan kedalam proyek <b>'.$proyek->judul.'</b>. Masuk kedalam akun staffmu dan mulai berkolaborasi dalam proyek tersebut';

            sendMail($staff->email, $subject, $message);

            $data = [
                'proyek_id' => $this->input->post('proyek_id'),
                'user_id' => $this->input->post('staff_id'),
                'created_at' => strtotime(date("Y-m-d")),
                'created_by' => $this->session->userdata('user_id')
            ];
    
            $this->db->insert('tb_assign_staff', $data);
        }
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function assignStaffBulk(){
        
        $this->db->trans_begin();

        foreach ($this->input->post('staff') as $key => $val) {
            
            if($this->cekAssignStaff(0, $val) == 1 || $this->cekAssignStaff(2, $val) ==  1){
                $this->db->where(['proyek_id' => $this->input->post('proyek_id'), 'user_id' => $val]);
                $this->db->update('tb_assign_staff', ['status' => 1]);
            }else{
            
                $proyek = $this->getProyekDetail($this->input->post('proyek_id'));
                $staff = $this->getStaffDetail($val);
                // email
                $subject = "Proyek Baru";
                $message = 'Hi '.$staff->nama.', kamu telah ditambahkan kedalam proyek <b>'.$proyek->judul.'</b>. Masuk kedalam akun staffmu dan mulai berkolaborasi dalam proyek tersebut';

                sendMail($staff->email, $subject, $message);

                $data = [
                    'proyek_id' => $this->input->post('proyek_id'),
                    'user_id' => $val,
                    'created_at' => strtotime(date("Y-m-d")),
                    'created_by' => $this->session->userdata('user_id')
                ];
                $this->db->insert('tb_assign_staff', $data);
            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }

    }

    function keluarkanStaff($proyek_id, $user_id){
        $this->db->where(['proyek_id' => $proyek_id, 'user_id' => $user_id]);
        $this->db->update('tb_assign_staff', ['status' => 2]);
        return ($this->db->affected_rows() != 1) ? false : true;

    }

    function insertDefaultStatus($proyek_id){
        // $status = [
        //     [
        //         'proyek_id' => $proyek_id,
        //         'status' => 'Todo',
        //         'warna' => 'secondary',
        //         'keterangan' => 'Status awal task yang baru dibuat',
        //         'urutan' => 1,
        //         'created_at' => strtotime(date("Y-m-d")),
        //         'created_by' => $this->session->userdata('user_id')
        //     ],
        //     [
        //         'proyek_id' => $proyek_id,
        //         'status' => 'Inprogress',
        //         'warna' => 'info',
        //         'keterangan' => 'Status untuk task dalam proses pengerjaan',
        //         'urutan' => 2,
        //         'created_at' => strtotime(date("Y-m-d")),
        //         'created_by' => $this->session->userdata('user_id')
        //     ],
        //     [
        //         'proyek_id' => $proyek_id,
        //         'status' => 'Done',
        //         'warna' => 'success',
        //         'keterangan' => 'Status untuk task yang telah selesai',
        //         'urutan' => 3,
        //         'created_at' => strtotime(date("Y-m-d")),
        //         'created_by' => $this->session->userdata('user_id')
        //     ]
        // ];

        $status = $this->db->get_where('m_status', ['is_deleted' => 0])->result();

        foreach($status as $key => $val):
            $data = [
                'proyek_id' => $proyek_id,
                'status' => $val->status,
                'warna' => $val->warna,
                'keterangan' => $val->keterangan,
                'urutan' => $val->urutan,
                'is_mulai' => $val->is_mulai,
                'is_selesai' => $val->is_selesai,
                'is_closed' => $val->is_closed,
                'is_default' => $val->is_default,
                'created_at' => strtotime(date("Y-m-d")),
                'created_by' => $this->session->userdata('user_id')
            ];
            $this->db->insert('tb_proyek_status', $data);
        endforeach;
        return true;
    }

    function insertLeaderProyek($leader_id, $proyek_id){

            $staff = $this->getStaffDetail($leader_id);
            // email
            $subject = "Proyek Baru";
            $message = 'Hi '.$staff->nama.', kamu telah ditambahkan sebagai leader kedalam proyek <b>'.$this->input->post('judul').'</b>. Masuk kedalam akunmu dan mulai berkolaborasi dalam proyek tersebut';

            sendMail($staff->email, $subject, $message);

            $data = [
                'proyek_id' => $proyek_id,
                'user_id' => $leader_id,
                'status' => 1,
                'created_at' => strtotime(date("Y-m-d")),
                'created_by' => $this->session->userdata('user_id')
            ];
            $this->db->insert('tb_assign_leader', $data);
        return true;
    }

    function insertStaffProyek($data, $proyek_id){

        foreach($data as $key => $val):
            $staff = $this->getStaffDetail($val);
            // email
            $subject = "Proyek Baru";
            $message = 'Hi '.$staff->nama.', kamu telah ditambahkan sebagai staff kedalam proyek <b>'.$this->input->post('judul').'</b>. Masuk kedalam akunmu dan mulai berkolaborasi dalam proyek tersebut';

            sendMail($staff->email, $subject, $message);

            $data = [
                'proyek_id' => $proyek_id,
                'user_id' => $val,
                'status' => 1,
                'created_at' => strtotime(date("Y-m-d")),
                'created_by' => $this->session->userdata('user_id')
            ];
            $this->db->insert('tb_assign_staff', $data);
        endforeach;
        return true;
    }

    function getStaffDetail($user_id){
        $this->db->select('a.email, b.*')
        ->from('tb_auth a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->where('a.user_id', $user_id)
        ;

        return $this->db->get()->row();
    }

    function getUrutanStatus(){
        $data = $this->db->get_where('tb_proyek_status', ['is_deleted' => 0])->result();
        $data = end($data);
        return $data->urutan;
    }

    function getDefaultStatus($proyek_id){
        return $this->db->get_where('tb_proyek_status', ['proyek_id' => $proyek_id, 'urutan' => 1, 'is_mulai' => 1, 'is_deleted' => 0])->row()->id;
    }

    function tambah_status(){
        
        $urutan = $this->getUrutanStatus();

        $data = [
            'proyek_id' => $this->input->post('proyek_id'),
            'status' => $this->input->post('status'),
            'warna' => $this->input->post('warna'),
            'keterangan' => $this->input->post('keterangan'),
            'urutan' => $urutan-1,
            'created_at' => strtotime(date("Y-m-d")),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_proyek_status', $data);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
        if($cek == true){
            $this->updateStatusSelesai($urutan+1, $this->input->post('proyek_id'));
            $this->updateStatusClosed($urutan+1, $this->input->post('proyek_id'));
            return true;
        }else{
            return false;
        }
    }

    function updateStatusSelesai($urutan, $proyek_id){
        $data = [
            'urutan' => $urutan,
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where(['is_selesai' => 1, 'proyek_id' => $proyek_id]);
        $this->db->update('tb_proyek_status', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function updateStatusClosed($urutan, $proyek_id){
        $data = [
            'urutan' => $urutan,
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where(['is_closed' => 1, 'proyek_id' => $proyek_id]);
        $this->db->update('tb_proyek_status', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function edit_status(){
        $data = [
            'proyek_id' => $this->input->post('proyek_id'),
            'status' => $this->input->post('status'),
            'warna' => $this->input->post('warna'),
            'keterangan' => $this->input->post('keterangan'),
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_proyek_status', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function hapus_status(){
        $urutan = $this->input->post('urutan');

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_proyek_status', ['is_deleted' => 1]);

        $cek = ($this->db->affected_rows() != 1) ? false : true;
        if($cek == true){
            $this->updateStatusSelesai($urutan, $this->input->post('proyek_id'));
            $this->updateStatusClosed($urutan, $this->input->post('proyek_id'));
            return true;
        }else{
            return false;
        }
    }

    function tambah_task(){
        
        $status_id = $this->getDefaultStatus($this->input->post('proyek_id'));

        $proyek = $this->getProyekDetail($this->input->post('proyek_id'));
        $staff = $this->getStaffDetail($this->input->post('staff_id'));
        // email
        $subject = "Task baru pada proyek {$proyek->judul}";
        $message = 'Hi '.$staff->nama.', kamu telah mendapatkan task baru, <b>'.$this->input->post('task').'</b> pada proyek <b>'.$proyek->judul.'</b>. Harap selesaikan task tersebut sebelum '.date("d-m-Y", strtotime($this->input->post('deadline')));

        sendMail($staff->email, $subject, $message);

        $data = [
            'proyek_id' => $this->input->post('proyek_id'),
            'user_id' => $this->input->post('staff_id'),
            'task' => $this->input->post('task'),
            'bobot' => $this->input->post('bobot'),
            'keterangan' => $this->input->post('keterangan'),
            'deadline' => strtotime($this->input->post('deadline')),
            'status_id' => $status_id,
            'created_at' => strtotime(date("Y-m-d")),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_proyek_task', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function edit_task(){
        
        $id = $this->input->post('id');

        $data = [
            'user_id' => $this->input->post('staff_id'),
            'task' => $this->input->post('task'),
            'bobot' => $this->input->post('bobot'),
            'keterangan' => $this->input->post('keterangan'),
            'is_selesai' => 0,
            'is_closed' => 0,
            'deadline' => strtotime($this->input->post('deadline')),
            'status_id' => $this->input->post('status_id'),
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_proyek_task', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function hapus_task($id){
        
        // $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_proyek_task', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function selesaikan_task($file = null){
        
        $id = $this->input->post('id');
        if($file == null){
            $data = [
                'catatan' => $this->input->post('catatan'),
                'is_selesai' => 1,
                'status_id' => $this->getStatus($this->input->post('proyek_id'), 1),
                'modified_at' => strtotime(date("Y-m-d")),
                'modified_by' => $this->session->userdata('user_id')
            ];
        }else{
            $data = [
                'bukti' => $file,
                'catatan' => $this->input->post('catatan'),
                'is_selesai' => 1,
                'status_id' => $this->getStatus($this->input->post('proyek_id'), 1),
                'modified_at' => strtotime(date("Y-m-d")),
                'modified_by' => $this->session->userdata('user_id')
            ];
        }

        $this->db->where('id', $id);
        $this->db->update('tb_proyek_task', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function tolak_task(){
        
        $id = $this->input->post('id');

        $data = [
            'catatan_ditolak' => $this->input->post('catatan_ditolak'),
            'is_selesai' => 0,
            'status_id' => $this->getStatus($this->input->post('proyek_id'), 0),
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_proyek_task', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function verifikasi_task(){
        
        $id = $this->input->post('id');

        $data = [
            'catatan_diterima' =>  $this->input->post('catatan_diterima'),
            'is_selesai' => 0,
            'is_closed' => 1,
            'status_id' => $this->getStatus($this->input->post('proyek_id'), 2),
            'modified_at' => strtotime(date("Y-m-d")),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_proyek_task', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function sematkan($id, $status){

        $this->db->where('id', $id);
        $this->db->update('tb_proyek', ['semat' => $status == 0 ? 1: 0]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function getStatus($proyek_id = null, $status = 1){

        if($status == 0){
            return $this->db->get_where('tb_proyek_status', ['urutan' => 2, 'proyek_id' => $proyek_id])->row()->id;
        }elseif($status == 1){
            return $this->db->get_where('tb_proyek_status', ['is_selesai' => 1, 'proyek_id' => $proyek_id])->row()->id;
        }elseif($status == 2){
            return $this->db->get_where('tb_proyek_status', ['is_closed' => 1, 'proyek_id' => $proyek_id])->row()->id;
        }else{
            return $this->db->get_where('tb_proyek_status', ['is_mulai' => 1, 'proyek_id' => $proyek_id])->row()->id;
        }
    }

    function getTaskKomentar($id){
        $this->db->select('*')
        ->from('tb_komentar_task a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->where(['a.task_id' => $id, 'is_deleted' => 0])
        ->order_by('a.created_at DESC')
        ;

        $models = $this->db->get()->result();

        foreach($models as $key => $val){
            $val->created_at = time_ago(date('Y-m-d H:i:s', $val->created_at));
        }

        return $models;
    }

    function tambahKomentar(){
        $data = [
            'task_id' => $this->input->post('id'),
            'user_id' => $this->session->userdata('user_id'),
            'komentar' => $this->input->post('komentar'),
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_komentar_task', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function hapusKomentar($id){
        $this->db->where('id', $id);
        $this->db->update('tb_komentar_task', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function getTaskBukti($task_id){
        $this->db->select('*')
        ->from('tb_task_bukti')
        ->where(['task_id' => $task_id, 'is_deleted' => 0])
        ;

        $models = $this->db->get()->result();

        foreach($models as $key => $val){
            $val->icon = '';
            $word = substr($val->bukti, -7);
            if(strpos($word, '.pdf') !== false){
                $val->icon = 'pdf';
            }
            if(strpos($word, '.docx') !== false){
                $val->icon = 'word';
            }
            if(strpos($word, '.pptx') !== false){
                $val->icon = 'ppt';
            }
            if(strpos($word, '.xlsx') !== false){
                $val->icon = 'excel';
            }
            if(strpos($word, '.jpg') !== false || strpos($word, '.jpeg') !== false || strpos($word, '.png') !== false){
                $val->icon = 'image';
            }
        }
        return $models;
    }

    function getLaporanStatusProyek($periode = []){
        $this->db->select('*')
        ->from('tb_proyek')
        ->where(['is_deleted' => 0 ])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['periode_mulai' => strtotime($periode[0])]);
            }else{
                $this->db->where(['periode_mulai >=' => strtotime($periode[0]), 'periode_mulai <=' => strtotime($periode[1])]);
            }
        }

        $models = $this->db->get()->result();
        
        $arr = (object) [];
        
        $arr->on_deadline = 0;
        $arr->over_deadline = 0;
        foreach ($models as $key => $val) {
            if($val->periode_selesai < time()){
                $arr->on_deadline += 1;
            }
            
            if($val->periode_selesai > time()){
                $arr->over_deadline += 1;
            }
        }

        $arr->data = [$arr->on_deadline, $arr->over_deadline];
        $arr->categories = ["'On Deadline'", "'Over Deadline'"];

        return $arr;
    }

    function getLaporanStatusProyekStaff(){
        $this->db->select('a.*')
        ->from('tb_proyek a')
        ->join('tb_proyek_task b', 'a.id = b.proyek_id')
        ->where(['a.is_deleted' => 0, 'b.user_id' => $this->session->userdata('user_id') ])
        ;

        $models = $this->db->get()->result();

        $arr = (object) [];
        
        $arr->on_deadline = 0;
        $arr->over_deadline = 0;
        foreach ($models as $key => $val) {
            if($val->periode_selesai < time()){
                $arr->on_deadline += 1;
            }
            
            if($val->periode_selesai > time()){
                $arr->over_deadline += 1;
            }
        }

        $arr->data = [$arr->on_deadline, $arr->over_deadline];
        $arr->categories = ["'On Deadline'", "'Over Deadline'"];

        return $arr;
    }

    function getLaporanStatusTaskProyek($proyek_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_status')
        ->where(['is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;

        $models = $this->db->get()->result();

        $arr = (object) [];
        $arr->categories = [];
        $arr->data = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr->categories[] = "'{$val->status}'";
                $arr->data[] = count($this->getDataChartTaskProyek($val->id, $periode));
            }
        }

        return $arr;
    }

    function getLaporanStatusTaskProyekStaff($proyek_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_status')
        ->where(['is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;

        $models = $this->db->get()->result();

        $arr = (object) [];
        $arr->categories = [];
        $arr->data = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr->categories[] = "'{$val->status}'";
                $arr->data[] = count($this->getDataChartTaskProyekStaff($val->id, $periode));
            }
        }

        return $arr;
    }

    function getDataChartTaskProyekStaff($status_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_task')
        ->where(['is_deleted' => 0 ])
        ->where(['status_id' => $status_id ])
        ->where(['user_id' => $this->session->userdata('user_id') ])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['created_at >=' => strtotime($periode[0]), 'created_at <=' => strtotime($periode[1])]);
            }
        }

        return $this->db->get()->result();
        // return $this->db->get_where('tb_proyek_task', ['status_id' => $status_id, 'user_id' => $this->session->userdata('user_id')])->result();
    }

    function getDataChartTaskProyek($status_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_task')
        ->where(['is_deleted' => 0 ])
        ->where(['status_id' => $status_id ])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['created_at >=' => strtotime($periode[0]), 'created_at <=' => strtotime($periode[1])]);
            }
        }

        return $this->db->get()->result();
        // return $this->db->get_where('tb_proyek_task', ['status_id' => $status_id])->result();
    }

    function getStaffTargetTaskStaff($proyek_id = null, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id, 'b.user_id' => $this->session->userdata('user_id')])
        ;

        $models = $this->db->get()->result();

        $arr = (object) [];
        $arr->categories = [];
        $arr->dateOnDeadline = [];
        $arr->dateOverDeadline = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr->categories[] = "'{$val->nama}'";
                $arr->dateOnDeadline[] = $this->getTaskTargetStaff($val->user_id, 1, $proyek_id, $periode);
                $arr->dateOverDeadline[] = $this->getTaskTargetStaff($val->user_id, 0, $proyek_id, $periode);
            }
        }

        return $arr;
    }

    function getStaffTargetTask($proyek_id = null, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;

        $models = $this->db->get()->result();

        $arr = (object) [];
        $arr->categories = [];
        $arr->dateOnDeadline = [];
        $arr->dateOverDeadline = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr->categories[] = "'{$val->nama}'";
                $arr->dateOnDeadline[] = $this->getTaskTargetStaff($val->user_id, 1, $proyek_id, $periode);
                $arr->dateOverDeadline[] = $this->getTaskTargetStaff($val->user_id, 0, $proyek_id, $periode);
            }
        }

        return $arr;
    }

    function getStaffTargetTaskTabelStaff($proyek_id = null, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id, 'b.user_id' => $this->session->userdata('user_id')])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr[$key]['nama'] = $val->nama;
                $arr[$key]['dateOnDeadline'] = $this->getTaskTargetStaff($val->user_id, 1, $proyek_id, $periode);
                $arr[$key]['dateOverDeadline'] = $this->getTaskTargetStaff($val->user_id, 0, $proyek_id, $periode);
            }
        }

        return $arr;
    }

    function getStaffTargetTaskTabel($proyek_id = null, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr[$key]['nama'] = $val->nama;
                $arr[$key]['dateOnDeadline'] = $this->getTaskTargetStaff($val->user_id, 1, $proyek_id, $periode);
                $arr[$key]['dateOverDeadline'] = $this->getTaskTargetStaff($val->user_id, 0, $proyek_id, $periode);
            }
        }

        return $arr;
    }

    function getTaskTargetStaff($user_id = null, $on_deadline = 1, $proyek_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_task')
        ->where(['is_deleted' => 0, 'user_id' => $user_id, 'proyek_id' => $proyek_id, 'is_selesai' => 0, 'is_closed' => 0])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['created_at >=' => strtotime($periode[0]), 'created_at <=' => strtotime($periode[1])]);
            }
        }

        $models = $this->db->get()->result();

        $total = 0;
        foreach($models as $key => $val){
            if($on_deadline == 1){
                if($val->deadline > time()){
                    $total += 1;
                }
            }else{
                if($val->deadline < time()){
                    $total += 1;
                }
            }
        }

        return $total;
    }

    function getLaporanTaskStaffStaff($proyek_id, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id, 'b.user_id' => $this->session->userdata('user_id')])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr['categories'][] = "'{$val->nama}'";
                $arr['series'] = $this->getSeriesLaporanTaskStaffStaff($proyek_id, $periode);
            }
        }

        return $arr;
    }

    function getLaporanTaskStaff($proyek_id, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr['categories'][] = "'{$val->nama}'";
                $arr['series'] = $this->getSeriesLaporanTaskStaff($proyek_id, $periode);
            }
        }

        return $arr;
    }

    function getLaporanTaskStaffTabel($proyek_id, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr[$key]['nama'] = $val->nama;
                $arr[$key]['status'] = $this->getSeriesLaporanTaskStaffTabel($proyek_id, $val->user_id, $periode);
            }
        }

        return $arr;
    }

    function getLaporanTaskStaffTabelStaff($proyek_id, $periode = []){
        $this->db->select('a.nama, b.*')
        ->from('tb_user a')
        ->join('tb_assign_staff b', 'a.user_id = b.user_id')
        ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id, 'b.user_id' => $this->session->userdata('user_id')])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr[$key]['nama'] = $val->nama;
                $arr[$key]['status'] = $this->getSeriesLaporanTaskStaffTabel($proyek_id, $val->user_id, $periode);
            }
        }

        return $arr;
    }

    function getSeriesLaporanTaskStaffTabel($proyek_id = null, $user_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_status')
        ->where(['is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;
        
        $models = $this->db->get()->result();

        $arr = [];
        foreach($models as $key => $val){
            $arr[$key]['nama'] = $val->status;
            $arr[$key]['total'] = $this->getTotalTaskUserStatus($val->id, $user_id, $periode);
        }

        return $arr;
    }

    function getTotalTaskUserStatus($status_id = null, $user_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_task')
        ->where(['is_deleted' => 0, 'status_id' => $status_id, 'user_id' => $user_id])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['created_at >=' => strtotime($periode[0]), 'created_at <=' => strtotime($periode[1])]);
            }
        }

        return $this->db->get()->num_rows();

    }

    function getSeriesLaporanTaskStaffStaff($proyek_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_status')
        ->where(['is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $arr[$val->id]['name'] = $val->status;

                $this->db->select('a.nama, b.*')
                ->from('tb_user a')
                ->join('tb_assign_staff b', 'a.user_id = b.user_id')
                ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id, 'b.user_id' => $this->session->userdata('user_id')])
                ;

                $staff = $this->db->get()->result();

                foreach($staff as $k => $v){
                    $total = $this->getTaskTargetStaffStatus($val->id, $v->user_id, $periode);
                    $arr[$val->id]['data'][] = $total == null ? 0 : $total;
                }
            }
        }

        return array_values($arr);

    }

    function getSeriesLaporanTaskStaff($proyek_id = null, $periode = []){
        $this->db->select('*')
        ->from('tb_proyek_status')
        ->where(['is_deleted' => 0, 'proyek_id' => $proyek_id])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['created_at >=' => strtotime($periode[0]), 'created_at <=' => strtotime($periode[1])]);
            }
        }

        $models = $this->db->get()->result();

        $arr = [];
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $arr[$val->id]['name'] = $val->status;

                $this->db->select('a.nama, b.*')
                ->from('tb_user a')
                ->join('tb_assign_staff b', 'a.user_id = b.user_id')
                ->where(['b.is_deleted' => 0, 'proyek_id' => $proyek_id])
                ;

                $staff = $this->db->get()->result();

                foreach($staff as $k => $v){
                    $total = $this->getTaskTargetStaffStatus($val->id, $v->user_id, $periode);
                    $arr[$val->id]['data'][] = $total == null ? 0 : $total;
                }
            }
        }

        return array_values($arr);

    }

    function getProyekStatusLaporan($proyek_id = null){
        return $this->db->get_where('tb_proyek_status', ['is_deleted' => 0, 'proyek_id' => $proyek_id])->result();
    }

    function getTaskTargetStaffStatus($status_id = null, $user_id = null, $periode = []){
        $this->db->select('COUNT(*) as total')
        ->from('tb_proyek_task a')
        ->where(['a.is_deleted' => 0, 'a.status_id' => $status_id, 'user_id' => $user_id])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['a.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['a.created_at >=' => strtotime($periode[0]), 'a.created_at <=' => strtotime($periode[1])]);
            }
        }

        $models = $this->db->get()->result();

        $arr = 0;
        foreach($models as $key => $val){
            $arr = (int) $val->total;
        }

        return ($arr);
    }

    function getLaporanProyek($periode = []){
        $this->db->select('a.*, c.nama')
        ->from('tb_proyek a')
        ->join('tb_assign_leader b', 'a.id = b.proyek_id')
        ->join('tb_user c', 'b.user_id = c.user_id')
        ->where(['a.is_deleted' => 0])
        ;

        if(!empty($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['a.periode_mulai' => strtotime($periode[0])]);
            }else{
                $this->db->where(['a.periode_mulai >=' => strtotime($periode[0]), 'a.periode_mulai <=' => strtotime($periode[1])]);
            }
        }

        $models = $this->db->get()->result();
        
        foreach($models as $key => $val){
            $val->over_deadline = false;
            if($val->periode_selesai < time()){
                $val->over_deadline = true;
            }

            $val->tasks = $this->getTasksLaporan($val->id)['status'] == true ? $this->getTasksLaporan($val->id)['data'] : null;
            $val->tasks_selesai = 0;
            if($val->tasks != null){
                foreach($val->tasks as $k => $v){
                    if($v->is_selesai == 1 || $v->is_closed == 1){
                        $val->tasks_selesai += 1;
                    }
                }
            }
        }
        
        return $models;
    }

    function getTasksLaporan($proyek_id){
        $this->db->select('a.*, b.nama, c.status, c.warna, c.is_selesai, c.is_closed')
        ->from('tb_proyek_task a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->join('tb_proyek_status c', 'a.status_id = c.id')
        ->where(['a.proyek_id' => $proyek_id, 'a.is_deleted' => 0])
        ;

        if(!empty($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['a.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['a.created_at >=' => strtotime($periode[0]), 'a.created_at <=' => strtotime($periode[1])]);
            }
        }

        $models = $this->db->get()->result();
        if(empty($models)){
            return [
                'status' => false,
                'data' => null
            ];
        }
        foreach($models as $key => $val){
            $val->over_deadline = false;
            if($val->deadline < time()){
                $val->over_deadline = true;
            }
        }
        
        return [
            'status' => true,
            'data' => $models
        ];
    }

    function getTasksLaporanAll($periode = []){
        $this->db->select('a.*, b.nama, c.status, c.warna, c.is_selesai, c.is_closed, d.judul')
        ->from('tb_proyek_task a')
        ->join('tb_user b', 'a.user_id = b.user_id')
        ->join('tb_proyek_status c', 'a.status_id = c.id')
        ->join('tb_proyek d', 'a.proyek_id = d.id')
        ->where(['a.is_deleted' => 0])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['a.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['a.created_at >=' => strtotime($periode[0]), 'a.created_at <=' => strtotime($periode[1])]);
            }
        }

        $models = $this->db->get()->result();
        
        foreach($models as $key => $val){
            $val->over_deadline = false;
            if($val->deadline < time() && ($val->is_selesai == 0 || $val->is_closed == 0)){
                $val->over_deadline = true;
            }
        }
        
        return $models;
    }

    function getManualKPI($proyek_id = null, $staff_id = null, $periode = []){
        $this->db->select('a.*, b.nama, c.judul')
        ->from('tb_kpi_manual a')
        ->join('tb_user b', 'a.staff_id = b.user_id')
        ->join('tb_proyek c', 'a.proyek_id = c.id')
        ->where(['a.is_deleted' => 0])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['a.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['a.created_at >=' => strtotime($periode[0]), 'a.created_at <=' => strtotime($periode[1])]);
            }
        }

        if(!is_null($proyek_id)){
            $this->db->where('proyek_id', $proyek_id);
        }

        if(!is_null($staff_id)){
            $this->db->where('staff_id', $staff_id);
        }

        $models = $this->db->get()->result();

        $arr = [];
        if($staff_id == null){
            $temp = [];
            $nilai = 0;
            foreach($models as $key => $val){
                $temp[$val->staff_id] = $val;
                $nilai += $val->nilai;
                $temp[$val->staff_id]->judul = "Seluruh proyek (pilih staff untuk lebih detail)";
                $temp[$val->staff_id]->nilai = $nilai;
            }
            $arr = $temp;
        }else{
            $arr = $models;
        }
        return $arr;
    }

    function getManualKPIGrafik($proyek_id = null, $staff_id = null, $periode = []){
        $this->db->select('a.*, b.nama, c.judul')
        ->from('tb_kpi_manual a')
        ->join('tb_user b', 'a.staff_id = b.user_id')
        ->join('tb_proyek c', 'a.proyek_id = c.id')
        ->where(['a.is_deleted' => 0])
        ;
        
        if(!empty($periode) && is_array($periode)){
            if(strtotime($periode[0]) == strtotime($periode[1])){
                $this->db->where(['a.created_at' => strtotime($periode[0])]);
            }else{
                $this->db->where(['a.created_at >=' => strtotime($periode[0]), 'a.created_at <=' => strtotime($periode[1])]);
            }
        }

        if(!is_null($proyek_id)){
            $this->db->where('proyek_id', $proyek_id);
        }

        if(!is_null($staff_id)){
            $this->db->where('staff_id', $staff_id);
        }

        $models = $this->db->get()->result();

        $arr = [];
        if($staff_id == null){
            $temp = [];
            $nilai = 0;
            foreach($models as $key => $val){
                $temp[$val->staff_id]['nama'] = $val->nama;
                $temp[$val->staff_id]['judul'] = $val->judul;
                $nilai += $val->nilai;
                $temp[$val->staff_id]['nilai'] = $nilai;
            }

            $temp = array_values($temp);

            foreach($temp as $key => $val){
                $arr['kategori'][] = "'{$val['judul']}'";
                $arr['name'][] = "'{$val['nama']}'";
                $arr['data'][] = $val['nilai'];
            }
        }else{
            foreach($models as $key => $val){
                $arr['kategori'][] = "'{$val->judul}'";
                $arr['name'][] = "'{$val->nama}'";
                $arr['data'][] = $val->nilai;
            }
        }

        return $arr;
    }
}
