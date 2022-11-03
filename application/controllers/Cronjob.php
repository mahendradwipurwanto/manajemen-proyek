<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_leader', 'api/M_master', 'api/M_auth']);
    }

    function index(){
        ej('Hai');
    }

    function reminderTask(){
        // ambil data reminder task
        $task = $this->M_master->getReminderTask();

        $data = [];
        // fetch data
        foreach($task as $key => $val){
            $deadline = date("d F Y", $val->deadline);
            // perhitungan deadline dari hari ini
            if (date("Y/m/d", $val->deadline) == date("Y/m/d", strtotime("+7 days", time()))) {
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task <b>{$val->task}</b> yang mendekati deadline dalam 7 hari lagi pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                $data[$val->nama]['staff'] = $val->nama; 
                $data[$val->nama]['task'][] = $val->task;
                sendMail($val->email, $subject, $message);
            }

            if(date("Y/m/d", $val->deadline) == date("Y/m/d", strtotime("+3 days", time()))){
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task <b>{$val->task}</b> yang mendekati deadline dalam 3 hari lagi pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                $data[$val->nama]['staff'] = $val->nama; 
                $data[$val->nama]['task'][] = $val->task;
                sendMail($val->email, $subject, $message);
            }

            if(date("Y/m/d", $val->deadline) == date("Y/m/d", strtotime("+1 days", time()))){
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task <b>{$val->task}</b> yang mendekati deadline besok pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                $data[$val->nama]['staff'] = $val->nama; 
                $data[$val->nama]['task'][] = $val->task;
                sendMail($val->email, $subject, $message);
            }
            if(time() > $val->deadline){
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task {$val->task} yang sudah melewati deadline pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                $data[$val->nama]['staff'] = $val->nama; 
                $data[$val->nama]['task'][] = $val->task;
                sendMail($val->email, $subject, $message);
            }
        }

        ej(array_values($data));
    }
}
