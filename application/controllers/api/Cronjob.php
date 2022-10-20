<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leader extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/M_leader', 'api/M_master', 'api/M_auth']);
    }

    function reminderTask(){
        // ambil data reminder task
        $task = $this->M_master->getReminderTask();

        // fetch data
        foreach($task as $key => $val){
            $deadline = date("d F Y");
            // perhitungan deadline dari hari ini
            if (date("Y/m/d", $val->tanggal) == date("Y/m/d", strtotime("+7 days", time()))) {
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task <b>{$val->task}</b> yang mendekati deadline dalam 7 hari lagi pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                sendMail($val->email, $subject, $message);
            }

            if(date("Y/m/d", $val->tanggal) == date("Y/m/d", strtotime("+3 days", time()))){
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task <b>{$val->task}</b> yang mendekati deadline dalam 3 hari lagi pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                sendMail($val->email, $subject, $message);
            }

            if(date("Y/m/d", $val->tanggal) == date("Y/m/d", strtotime("+1 days", time()))){
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task <b>{$val->task}</b> yang mendekati deadline besok pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                sendMail($val->email, $subject, $message);
            }
            if(time() > $val->tanggal){
                $subject = "Pengingat Deadline";
                $message = "Hai, {$val->nama} kamu memiliki task {$val->tagihan} yang sudah melewati deadline pada {$deadline}. Harap segera selesaikan taskmu sebelum waktu deadline untuk mendapatkan nilai";

                sendMail($val->email, $subject, $message);
            }
        }
    }
}
