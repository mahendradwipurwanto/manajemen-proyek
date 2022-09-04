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

    function getLogProyek(){
        $this->db->select('a.*, b.nama');
        $this->db->from('log_proyek a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->where(['a.is_deleted' => 0]);
        $this->db->order_by('a.created_at DESC');
        $models = $this->db->get()->result();

        foreach($models as $key => $val){
            $nama = explode(" ", $val->nama);
            $val->nama = $nama[0];
            $val->created_at = time_ago(date('Y-m-d H:i:s', $val->created_at));
        }

        return $models;
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
        $this->db->where(['c.created_by' => $this->session->userdata('user_id'), 'a.is_deleted' => 0]);
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
        $this->db->order_by('created_at DESC');
        return $this->db->get()->result();
    }

    function getProyekId($kode){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where('kode', $kode);;
        return $this->db->get()->row()->id;
    }

    function getAllStatus($status = 1, $archived = 0){
        $this->db->select('*');
        $this->db->from('tb_proyek');
        $this->db->where(['status' => $status, 'is_deleted' => 0]);
        if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3){
            $this->db->where('created_by', $this->session->userdata('user_id'));
        }
        $this->db->order_by('created_at DESC');
        $proyek = $this->db->get()->result();

        $arr = [];
        foreach($proyek as $key => $val):
            $arr[$key] = $val;
            $arr[$key]->staff = $this->getStaffProyek($val->id, 1);
            $arr[$key]->staff_free = $this->getStaffProyek($val->id, 0);
        endforeach;

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
            $val->diubah_pada = $val->modified_at == 0 ? '-' : date("d M Y", $val->modified_at);
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
        return $this->db->get()->row();
    }

    function getProyekStatus($kode = null){

        $idProyek = $this->getDetail($kode);

        $this->db->select('*');
        $this->db->from('tb_proyek_status');
        $this->db->where(['proyek_id' => $idProyek->id, 'is_deleted' => 0]);
        $this->db->order_by('urutan ASC');
        return $this->db->get()->result();
    }

    function save(){
        $data = [
            'kode' => strtolower($this->input->post('kode')),
            'judul' => $this->input->post('judul'),
            'periode_mulai' => strtotime($this->input->post('periode_mulai')),
            'periode_selesai' => strtotime($this->input->post('periode_selesai')),
            'keterangan' => $this->input->post('keterangan'),
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_proyek', $data);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
        
        if($cek == true){
            $proyek_id = $this->db->insert_id();
            $this->insertDefaultStatus($proyek_id);
            $this->insertStaffProyek($this->input->post('staff'), $proyek_id);
            return true;
        }else{
            return false;
        }
    }

    function edit(){
        $data = [
            'judul' => $this->input->post('judul'),
            'periode_mulai' => strtotime($this->input->post('periode_mulai')),
            'periode_selesai' => strtotime($this->input->post('periode_selesai')),
            'keterangan' => $this->input->post('keterangan'),
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_proyek', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
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
            $data = [
                'proyek_id' => $this->input->post('proyek_id'),
                'user_id' => $this->input->post('staff_id'),
                'created_at' => time(),
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
                $data = [
                    'proyek_id' => $this->input->post('proyek_id'),
                    'user_id' => $val,
                    'created_at' => time(),
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
        //         'created_at' => time(),
        //         'created_by' => $this->session->userdata('user_id')
        //     ],
        //     [
        //         'proyek_id' => $proyek_id,
        //         'status' => 'Inprogress',
        //         'warna' => 'info',
        //         'keterangan' => 'Status untuk task dalam proses pengerjaan',
        //         'urutan' => 2,
        //         'created_at' => time(),
        //         'created_by' => $this->session->userdata('user_id')
        //     ],
        //     [
        //         'proyek_id' => $proyek_id,
        //         'status' => 'Done',
        //         'warna' => 'success',
        //         'keterangan' => 'Status untuk task yang telah selesai',
        //         'urutan' => 3,
        //         'created_at' => time(),
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
                'is_default' => $val->is_default,
                'created_at' => time(),
                'created_by' => $this->session->userdata('user_id')
            ];
            $this->db->insert('tb_proyek_status', $data);
        endforeach;
        return true;
    }

    function insertStaffProyek($data, $proyek_id){

        foreach($data as $key => $val):
            $data = [
                'proyek_id' => $proyek_id,
                'user_id' => $val,
                'status' => 1,
                'created_at' => time(),
                'created_by' => $this->session->userdata('user_id')
            ];
            $this->db->insert('tb_assign_staff', $data);
        endforeach;
        return true;
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
            'urutan' => $urutan,
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_proyek_status', $data);
        $cek = ($this->db->affected_rows() != 1) ? false : true;
        if($cek == true){
            $this->updateStatusSelesai($urutan+1);
            return true;
        }else{
            return false;
        }
    }

    function updateStatusSelesai($urutan){
        $data = [
            'urutan' => $urutan,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('is_selesai', 1);
        $this->db->update('tb_proyek_status', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function edit_status(){
        $data = [
            'proyek_id' => $this->input->post('proyek_id'),
            'status' => $this->input->post('status'),
            'warna' => $this->input->post('warna'),
            'keterangan' => $this->input->post('keterangan'),
            'modified_at' => time(),
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
            $this->updateStatusSelesai($urutan);
            return true;
        }else{
            return false;
        }
    }

    function tambah_task(){
        
        $status_id = $this->getDefaultStatus($this->input->post('proyek_id'));

        $data = [
            'proyek_id' => $this->input->post('proyek_id'),
            'user_id' => $this->input->post('staff_id'),
            'task' => $this->input->post('task'),
            'bobot' => $this->input->post('bobot'),
            'keterangan' => $this->input->post('keterangan'),
            'status_id' => $status_id,
            'created_at' => time(),
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
            'status_id' => $this->input->post('status_id'),
            'modified_at' => time(),
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
}