<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('convertToBase64')) {
    function convertToBase64($path)
    {
        // $path = FCPATH.$path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}

if (!function_exists('ej')) {
    function ej($params)
    {
        echo json_encode($params);

        exit;
    }
}

if (!function_exists('time_ago')) {
    function time_ago($datetime, $full = false)
    {

        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';

    }
}

if (!function_exists('sendMail')) {
    function sendMail($email, $subject, $message)
    {
        $_ci = &get_instance();
        $_ci->load->library('mailer');

        $mail = [
            'to' => $email,
            'subject' => $subject,
            'message' => $message
        ];

        if ($_ci->mailer->send($mail) == true) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('sendMailTest')) {
    function sendMailTest($email, $subject, $message)
    {
        $_ci = &get_instance();
        $_ci->load->library('mailer');

        $mail = [
            'to' => $email,
            'subject' => $subject,
            'message' => $message
        ];

        return $_ci->mailer->sendTest($mail);
    }
}
    
if (!function_exists('penalty_remaining')) {
    function penalty_remaining($datetime, $full = false)
    {
        // $datetime = date(" Y - m - d H : i : s ", time()+120);
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'i' => 'Menit ',
            's' => 'Detik ',
        ];
        $a = null;
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
                $a .= $v;
            } else {
                unset($string[$k]);
            }
        }
        return $a;
    }
}


if (!function_exists('arrToObj')) {
    function arrToObj($data) {
    if (gettype($data) == 'array')
        return (object)array_map("arrToObj", $data);
    else
        return $data;
    }
}
