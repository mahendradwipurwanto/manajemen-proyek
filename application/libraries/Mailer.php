<?php defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    protected $_ci;
  
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    public function get_settingsValue($key)
    {
        $query = $this->_ci->db->get_where('tb_settings', ['key' => $key]);
        return $query->row()->value;
    }
  
  
    public function send($data)
    {
        // Include PHPMailer library files
        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';
    
        $mail = new PHPMailer(true);

        try {

        // SMTP configuration
            if($this->get_settingsValue('mailer_smtp') == 1){
              $mail->isSMTP();
            }

            $mail->SMTPOptions = array(
              'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
              )
            );

            $mail->SMTPDebug      = $this->get_settingsValue('mailer_mode');
            $mail->SMTPAuth       = true;
            $mail->SMTPKeepAlive  = true;
            $mail->SMTPSecure     = "tls";
            $mail->Port           = $this->get_settingsValue('mailer_port'); #587;
            $mail->Host           = $this->get_settingsValue('mailer_host'); #"smtp.gmail.com";
            $mail->Username       = $this->get_settingsValue('mailer_username'); #"ngodingin.indonesia@gmail.com";
            $mail->Password       = $this->get_settingsValue('mailer_password'); #"hxexyuauljnejjmq";
            
            $mail->setFrom($this->get_settingsValue('mailer_username'), $this->get_settingsValue('mailer_alias'));
            $mail->addReplyTo($this->get_settingsValue('mailer_username'), $this->get_settingsValue('mailer_alias'));
        
            // Add a recipient
            $mail->addAddress($data['to']);
        
            // Email subject
            $mail->Subject = $data['subject'];
        
            // Set email format to HTML
            $mail->isHTML(true);
            // Email body content
            $mail->Body = $this->body_html($data['message']);
        
            // Send email
            if (!$mail->send()) {
                echo `
                  <!DOCTYPE html>
                  <html lang="en">
                  <head>
                  <meta charset="utf-8">
                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                  <meta name="viewport" content="width=device-width, initial-scale=1">

                  <title>Mailer error</title>

                  <style id="" media="all">/* cyrillic-ext */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCAIT5lu.woff2) format('woff2');
                    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
                  }
                  /* cyrillic */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCkIT5lu.woff2) format('woff2');
                    unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
                  }
                  /* vietnamese */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCIIT5lu.woff2) format('woff2');
                    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
                  }
                  /* latin-ext */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCMIT5lu.woff2) format('woff2');
                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
                  }
                  /* latin */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyC0ITw.woff2) format('woff2');
                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
                  }
                  /* cyrillic-ext */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCAIT5lu.woff2) format('woff2');
                    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
                  }
                  /* cyrillic */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCkIT5lu.woff2) format('woff2');
                    unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
                  }
                  /* vietnamese */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCIIT5lu.woff2) format('woff2');
                    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
                  }
                  /* latin-ext */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCMIT5lu.woff2) format('woff2');
                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
                  }
                  /* latin */
                  @font-face {
                    font-family: 'Raleway';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyC0ITw.woff2) format('woff2');
                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
                  }
                  </style>
                  <style id="" media="all">/* latin-ext */
                  @font-face {
                    font-family: 'Passion One';
                    font-style: normal;
                    font-weight: 900;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/passionone/v16/Pby6FmL8HhTPqbjUzux3JEMS0U7hyJcsuA.woff2) format('woff2');
                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
                  }
                  /* latin */
                  @font-face {
                    font-family: 'Passion One';
                    font-style: normal;
                    font-weight: 900;
                    font-display: swap;
                    src: url(/fonts.gstatic.com/s/passionone/v16/Pby6FmL8HhTPqbjUzux3JEMS0U7vyJc.woff2) format('woff2');
                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
                  }
                  </style>

                  <link type="text/css" rel="stylesheet" href="css/style.css" />


                  <!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                      <![endif]-->
                  <meta name="robots" content="noindex, follow">
                  <script nonce="e55a28fa-7b9f-4e21-9a75-16cff8a0df7f">(function(w,d){!function(a,e,t,r){a.zarazData=a.zarazData||{};a.zarazData.executed=[];a.zaraz={deferred:[]};a.zaraz.q=[];a.zaraz._f=function(e){return function(){var t=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:t})}};for(const e of["track","set","ecommerce","debug"])a.zaraz[e]=a.zaraz._f(e);a.zaraz.init=()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r),n=e.getElementsByTagName("title")[0];n&&(a.zarazData.t=e.getElementsByTagName("title")[0].text);a.zarazData.x=Math.random();a.zarazData.w=a.screen.width;a.zarazData.h=a.screen.height;a.zarazData.j=a.innerHeight;a.zarazData.e=a.innerWidth;a.zarazData.l=a.location.href;a.zarazData.r=e.referrer;a.zarazData.k=a.screen.colorDepth;a.zarazData.n=e.characterSet;a.zarazData.o=(new Date).getTimezoneOffset();a.zarazData.q=[];for(;a.zaraz.q.length;){const e=a.zaraz.q.shift();a.zarazData.q.push(e)}z.defer=!0;for(const e of[localStorage,sessionStorage])Object.keys(e||{}).filter((a=>a.startsWith("_zaraz_"))).forEach((t=>{try{a.zarazData["z_"+t.slice(7)]=JSON.parse(e.getItem(t))}catch{a.zarazData["z_"+t.slice(7)]=e.getItem(t)}}));z.referrerPolicy="origin";z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData)));t.parentNode.insertBefore(z,t)};["complete","interactive"].includes(e.readyState)?zaraz.init():a.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head>
                  <body>
                  <div id="notfound">
                  <div class="notfound">
                  <div class="notfound-404">
                  <h1>:(</h1>
                  </div>
                  <h2>500 - Mailer error</h2>
                  <p>There is an error with mailer system, detail: `.$mail->ErrorInfo.`</p>
                  <a href="javascript:history.back()">Back</a>
                  </div>
                  </div>
                  </body>
                  </html>
                `;
                die();
                return false;
            } else {
                return true;
            }
            $mail->clearAddresses();
            $mail->clearAttachments();
        } catch (Exception $e) {
            echo `
              <!DOCTYPE html>
              <html lang="en">
              <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">

              <title>Mailer error</title>

              <style id="" media="all">/* cyrillic-ext */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCAIT5lu.woff2) format('woff2');
                unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
              }
              /* cyrillic */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCkIT5lu.woff2) format('woff2');
                unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
              }
              /* vietnamese */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCIIT5lu.woff2) format('woff2');
                unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
              }
              /* latin-ext */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCMIT5lu.woff2) format('woff2');
                unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
              }
              /* latin */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyC0ITw.woff2) format('woff2');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
              }
              /* cyrillic-ext */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 700;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCAIT5lu.woff2) format('woff2');
                unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
              }
              /* cyrillic */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 700;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCkIT5lu.woff2) format('woff2');
                unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
              }
              /* vietnamese */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 700;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCIIT5lu.woff2) format('woff2');
                unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
              }
              /* latin-ext */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 700;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyCMIT5lu.woff2) format('woff2');
                unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
              }
              /* latin */
              @font-face {
                font-family: 'Raleway';
                font-style: normal;
                font-weight: 700;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/raleway/v28/1Ptug8zYS_SKggPNyC0ITw.woff2) format('woff2');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
              }
              </style>
              <style id="" media="all">/* latin-ext */
              @font-face {
                font-family: 'Passion One';
                font-style: normal;
                font-weight: 900;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/passionone/v16/Pby6FmL8HhTPqbjUzux3JEMS0U7hyJcsuA.woff2) format('woff2');
                unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
              }
              /* latin */
              @font-face {
                font-family: 'Passion One';
                font-style: normal;
                font-weight: 900;
                font-display: swap;
                src: url(/fonts.gstatic.com/s/passionone/v16/Pby6FmL8HhTPqbjUzux3JEMS0U7vyJc.woff2) format('woff2');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
              }
              </style>

              <link type="text/css" rel="stylesheet" href="css/style.css" />


              <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                  <![endif]-->
              <meta name="robots" content="noindex, follow">
              <script nonce="e55a28fa-7b9f-4e21-9a75-16cff8a0df7f">(function(w,d){!function(a,e,t,r){a.zarazData=a.zarazData||{};a.zarazData.executed=[];a.zaraz={deferred:[]};a.zaraz.q=[];a.zaraz._f=function(e){return function(){var t=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:t})}};for(const e of["track","set","ecommerce","debug"])a.zaraz[e]=a.zaraz._f(e);a.zaraz.init=()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r),n=e.getElementsByTagName("title")[0];n&&(a.zarazData.t=e.getElementsByTagName("title")[0].text);a.zarazData.x=Math.random();a.zarazData.w=a.screen.width;a.zarazData.h=a.screen.height;a.zarazData.j=a.innerHeight;a.zarazData.e=a.innerWidth;a.zarazData.l=a.location.href;a.zarazData.r=e.referrer;a.zarazData.k=a.screen.colorDepth;a.zarazData.n=e.characterSet;a.zarazData.o=(new Date).getTimezoneOffset();a.zarazData.q=[];for(;a.zaraz.q.length;){const e=a.zaraz.q.shift();a.zarazData.q.push(e)}z.defer=!0;for(const e of[localStorage,sessionStorage])Object.keys(e||{}).filter((a=>a.startsWith("_zaraz_"))).forEach((t=>{try{a.zarazData["z_"+t.slice(7)]=JSON.parse(e.getItem(t))}catch{a.zarazData["z_"+t.slice(7)]=e.getItem(t)}}));z.referrerPolicy="origin";z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData)));t.parentNode.insertBefore(z,t)};["complete","interactive"].includes(e.readyState)?zaraz.init():a.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head>
              <body>
              <div id="notfound">
              <div class="notfound">
              <div class="notfound-404">
              <h1>:(</h1>
              </div>
              <h2>500 - Mailer error</h2>
              <p>There is an error with mailer system, detail: `.$mail->ErrorInfo.`</p>
              <a href="javascript:history.back()">Back</a>
              </div>
              </div>
              </body>
              </html>
            `;
            die();
        }
    }
      
    public function body_html($message)
    {
        return '
          <!DOCTYPE HTML
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
            xmlns:o="urn:schemas-microsoft-com:office:office">

          <head>
            <!--[if gte mso 9]>
          <xml>
            <o:OfficeDocumentSettings>
              <o:AllowPNG/>
              <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
          </xml>
          <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>

            <style type="text/css">
              @media only screen and (min-width: 570px) {
                .u-row {
                  width: 550px !important;
                }

                .u-row .u-col {
                  vertical-align: top;
                }

                .u-row .u-col-100 {
                  width: 550px !important;
                }

              }

              @media (max-width: 570px) {
                .u-row-container {
                  max-width: 100% !important;
                  padding-left: 0px !important;
                  padding-right: 0px !important;
                }

                .u-row .u-col {
                  min-width: 320px !important;
                  max-width: 100% !important;
                  display: block !important;
                }

                .u-row {
                  width: calc(100% - 40px) !important;
                }

                .u-col {
                  width: 100% !important;
                }

                .u-col>div {
                  margin: 0 auto;
                }
              }

              body {
                margin: 0;
                padding: 0;
              }

              table,
              tr,
              td {
                vertical-align: top;
                border-collapse: collapse;
              }

              p {
                margin: 0;
              }

              .ie-container table,
              .mso-container table {
                table-layout: fixed;
              }

              table,
              td {
                color: #000000;
              }

              a {
                color: #377dff;
                text-decoration: underline;
              }

              @media (max-width: 480px) {
                #u_content_image_1 .v-src-width {
                  width: auto !important;
                }

                #u_content_image_1 .v-src-max-width {
                  max-width: 55% !important;
                }

                #u_content_text_1 .v-container-padding-padding {
                  padding: 30px 30px 30px 20px !important;
                }

                #u_content_button_1 .v-container-padding-padding {
                  padding: 10px 20px !important;
                }

                #u_content_button_1 .v-size-width {
                  width: 100% !important;
                }

                #u_content_button_1 .v-text-align {
                  text-align: left !important;
                }

                #u_content_button_1 .v-padding {
                  padding: 15px 40px !important;
                }

                #u_content_text_3 .v-container-padding-padding {
                  padding: 30px 30px 80px 20px !important;
                }
              }
            </style>



            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Cabin:400,700&display=swap" rel="stylesheet" type="text/css">
            <!--<![endif]-->

          </head>

          <body class="clean-body u_body"
            style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f8f8f8;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table
              style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f8f8f8;width:100%"
              cellpadding="0" cellspacing="0">
              <tbody>
                <tr style="vertical-align: top">
                  <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #f8f8f8;"><![endif]-->


                    <div class="u-row-container" style="padding: 0px;background-color: #ffffff">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: #ffffff;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->

                          <!--[if (mso)|(IE)]><td align="center" width="550" style="background-color: #ffffff;width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div style="background-color: #ffffff;width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->

                                <table id="u_content_image_1" style="font-family:Cabin,sans-serif;" role="presentation"
                                  cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td class="v-container-padding-padding"
                                        style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 33px;font-family:Cabin,sans-serif;"
                                        align="left">

                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td class="v-text-align" style="padding-right: 0px;padding-left: 0px;" align="center">
                                              <a href="' . base_url() . '" target="_blank">
                                                <img align="center" border="0" src="'.base_url().'assets/images/logo.png" alt="Logo" title="Logo"
                                                  style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 55%;max-width: 291.5px;"
                                                  width="291.5" class="v-src-width v-src-max-width" />
                                              </a>
                                            </td>
                                          </tr>
                                        </table>

                                      </td>
                                    </tr>
                                  </tbody>
                                </table>

                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>



                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->

                          <!--[if (mso)|(IE)]><td align="center" width="542" style="background-color: #ffffff;width: 542px;padding: 20px;border-top: 4px solid #ffffff;border-left: 4px solid #ffffff;border-right: 4px solid #ffffff;border-bottom: 4px solid #ffffff;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div
                              style="background-color: #ffffff;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 20px;border-top: 4px solid #ffffff;border-left: 4px solid #ffffff;border-right: 4px solid #ffffff;border-bottom: 4px solid #ffffff;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->

                                <table id="u_content_text_1" style="font-family:Cabin,sans-serif;" role="presentation"
                                  cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td class="v-container-padding-padding"
                                        style="overflow-wrap:break-word;word-break:break-word;padding:20px 30px 30px 40px;font-family:Cabin,sans-serif;"
                                        align="left">

                                        <div class="v-text-align"
                                          style="color: #333333; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-family: Cabin, sans-serif; font-size: 14px; line-height: 19.6px;"><strong><span
                                                  style="font-size: 22px; line-height: 30.8px;">Hello!</span></strong></span></p>
                                          <p style="font-size: 14px; line-height: 140%;">&nbsp;</p>
                                          <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-size: 18px; line-height: 25.2px; font-family: Cabin, sans-serif;">'.$message.'</span></p>
                                        </div>

                                      </td>
                                    </tr>
                                  </tbody>
                                </table>

                                <table id="u_content_text_3" style="font-family:Cabin,sans-serif;" role="presentation"
                                  cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td class="v-container-padding-padding"
                                        style="overflow-wrap:break-word;word-break:break-word;padding:40px 30px 50px 40px;font-family:Cabin,sans-serif;"
                                        align="left">

                                        <div class="v-text-align"
                                          style="color: #333333; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%;">&nbsp;</p>
                                          <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-size: 22px; line-height: 30.8px; font-family: Cabin, sans-serif;"><strong><span
                                                  style="line-height: 30.8px; font-size: 22px;">Terima kasih, salam.</span></strong></span><br /><span
                                              style="font-size: 18px; line-height: 25.2px; font-family: Cabin, sans-serif;">Admin</span></p>
                                        </div>

                                      </td>
                                    </tr>
                                  </tbody>
                                </table>

                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>



                    <div class="u-row-container" style="padding: 10px 0px 20px;background-color: #ffffff">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 10px 0px 20px;background-color: #ffffff;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->

                          <!--[if (mso)|(IE)]><td align="center" width="550" style="background-color: #ffffff;width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div
                              style="background-color: #ffffff;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->

                                <table style="font-family:Cabin,sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
                                  width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td class="v-container-padding-padding"
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:Cabin,sans-serif;"
                                        align="left">

                                        <h4 class="v-text-align"
                                          style="margin: 0px; line-height: 100%; text-align: center; word-wrap: break-word; font-weight: normal; font-family:Cabin,sans-serif; font-size: 10px;">
                                          This email is generate by our system, please do not reply to this email
                                          directly<br /><br />@Ngodingin Indonesia
                                        </h4>

                                      </td>
                                    </tr>
                                  </tbody>
                                </table>

                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>


                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                  </td>
                </tr>
              </tbody>
            </table>
            <!--[if mso]></div><![endif]-->
            <!--[if IE]></div><![endif]-->
          </body>

          </html>
        ';
    }
}
