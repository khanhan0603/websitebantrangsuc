<?php
//Set Session
function setSession($key, $value){
    if(!empty(session_id())){
        $_SESSION[$key]=$value;
        return true;
    }
    return false;
}

// Lấy dữ liệu từ Session
function getSession($key = ''){
    if ($key === '') {
        return $_SESSION;
    }

    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }

    return false;
}

// Xóa Session
function removeSession($key=''){
    if(empty($key)){
        session_destroy();
        return true;
    }
    else{
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
            
        }
        return true;
    }
    return false;
}

// Tạo session flash -> chỉ tồn tại chớp nhoáng
function setSessionFlash($key,$value){
    $key=$key.'Flash';
    $rel=setSession($key,$value);
    return $rel;
}
// Lấy dữ liệu session flash và xóa nó khỏi session
function getSessionFlash($key){
     $key = $key.'Flash';
    $value = $_SESSION[$key] ?? null; // KHÔNG gây lỗi
    unset($_SESSION[$key]);
    return $value;
}