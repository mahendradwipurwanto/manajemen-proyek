<?php

class TemplateBack
{
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    public function getSettingsValue($key)
    {
        $query = $this->_ci->db->get_where('tb_settings', ['key' => $key]);
        return $query->row()->value;
    }

    public function getProyekSemat()
    {
        $query = $this->_ci->db->get_where('tb_proyek', ['semat' => 1, 'created_by' => $this->_ci->session->userdata('user_id'), 'is_deleted' => 0]);
        return $query->result();
    }

    public function view($content, $data = null)
    {
        $data['web_title'] = $this->getSettingsValue('web_title');
        $data['web_desc'] = $this->getSettingsValue('web_desc');
        $data['web_icon'] = $this->getSettingsValue('web_icon');
        $data['web_logo'] = $this->getSettingsValue('web_logo');
        $data['web_alamat'] = $this->getSettingsValue('web_alamat');
        $data['web_telepon'] = $this->getSettingsValue('web_telepon');

        $data['sosmed_ig'] = $this->getSettingsValue('sosmed_ig');
        $data['sosmed_twitter'] = $this->getSettingsValue('sosmed_twitter');
        $data['sosmed_facebook'] = $this->getSettingsValue('sosmed_facebook');
        $data['sosmed_yt'] = $this->getSettingsValue('sosmed_yt');

        $data['leader_daftar'] = $this->getSettingsValue('leader_daftar');
        
        $data['proyek_semat'] = $this->getProyekSemat();

        $this->_ci->load->view('template/backend/header', $data);
        $this->_ci->load->view('template/alert', $data);
        $this->_ci->load->view('template/backend/navbar', $data);
        if($this->_ci->session->userdata('role') == 3){
            $this->_ci->load->view('template/backend/sidebar_staff', $data);
        }else{
            $this->_ci->load->view('template/backend/sidebar', $data);
        }
        $this->_ci->load->view('template/backend/sidebar_task', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('template/backend/footer', $data);
    }
}
