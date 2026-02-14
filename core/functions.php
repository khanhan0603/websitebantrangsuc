<?php
function reload($path = ''){
    $root = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    header('Location: ' . $root . '/' . ltrim($path, '/'));
    exit;
}
// Kiểm tra phuơng thức POST
function isPost(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        return true;
    }
    return false;
}

// Phương thức GET
function isGet(){
    if($_SERVER['REQUEST_METHOD']=='GET'){
        return true;
    }
    return false;
}


// Lọc dữ liệu từ form
function filterData($method=''){
    $filterArr=[];
    if(empty($method)){
        if(isGet()){
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    $key=strip_tags($key);
                    if(is_array($value)){
                        $filterArr[$key]=filter_var($_GET[$key],FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                    }
                    else{
                        $filterArr[$key]=filter_var($_GET[$key],FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        if(isPost()){
            if(!empty($_POST)){
                foreach($_POST as $key => $value){
                    $key=strip_tags($key);
                    if(is_array($value)){
                        $filterArr[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                    }
                    else{
                        $filterArr[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    }
    else{
        if($method=='get'){
             foreach($_GET as $key => $value){
                    $key=strip_tags($key);
                    if(is_array($value)){
                        $filterArr[$key]=filter_var($_GET[$key],FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                    }
                    else{
                        $filterArr[$key]=filter_var($_GET[$key],FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
        }
        else if($method=='post'){
            foreach($_POST as $key => $value){
                    $key=strip_tags($key);
                    if(is_array($value)){
                        $filterArr[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                    }
                    else{
                        $filterArr[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
        }
    }
    return $filterArr;
}

// Hàm validate email
function validateEmail($email){
    if(!empty($email)){
        $checkEmail=filter_var($email,FILTER_VALIDATE_EMAIL);
    }
    return $checkEmail;
}

// Hàm validate int
function validateInt($int){
    if(!empty($int)){
        $checkInt=filter_var($int,FILTER_VALIDATE_INT);
    }
    return $checkInt;
}

// Hàm validate phone
function validatePhone($phone){
    $phoneFirst=false;
    // Cắt ký tự đầu tiên
    if($phone[0]=='0'){
        $phoneFirst=true;
        $phone=substr($phone,1);
    }
    $checkPhone=false;
    if(validateInt($phone)){
        $checkPhone=true;
    }
    if($phoneFirst && $checkPhone){
        return true;
    }
    return false;
}


// Hàm gửi mail

require_once __DIR__ . '/mailer/Exception.php';
require_once __DIR__ . '/mailer/PHPMailer.php';
require_once __DIR__ . '/mailer/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($emailTo, $subject, $content)
{

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'lmkhanhan@gmail.com';                     //SMTP username
        $mail->Password   = 'iixv ckyx xdpp ehej';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('lmkhanhan@gmail.com', 'TLA JEW');
        $mail->addAddress($emailTo);     //Add a recipient


        //Content
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;


        $mail->SMTPOptions = array(
            'ssl' => [
                'verify_peer' => true,
                'verify_depth' => 3,
                'allow_self_signed' => true,

            ],
        );

        return $mail->send();
    } catch (Exception $e) {
        echo "Gửi thất bại. Mailer Error: {$mail->ErrorInfo}";
    }
}
