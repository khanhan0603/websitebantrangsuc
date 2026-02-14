<?php
class BaseController{
    public function renderView($view,$data=[]){
         // Luôn gán cartCount vào data khi render view
        $data['cartCount'] = $this->loadCartCount();

        extract($data);

            // Những view KHÔNG include header
        $ignoreHeader = [
            'layouts-part/landingpage',
            'layouts-part/admin/login_admin',
            'layouts-part/admin/thongtin_admin',
            'layouts-part/admin/tatcadonhang_admin',
            'layouts-part/admin/add',
            'layouts-part/admin/addLSP',
            'layouts-part/admin/sanphamcuatoi',
            'layouts-part/admin/update',
            'layouts-part/admin/updateloai',
            'layouts-part/admin/loaisanpham',
            'layouts-part/signup',
            'layouts-part/login_khachhang',
            'layouts-part/order_confirmation',
            'main/dashboard',
            'main/baitaptuan2',
            'main/baitaptuan3',
            'main/baitaptuan4',
            'main/baitaptuan5',
            'main/baitaptuan6',
            'main/baitaptuan7',
            'main/baitaptuan8',
        ];

        // Nếu view hiện tại KHÔNG thuộc danh sách ignore → include header
        if (!in_array($view, $ignoreHeader)) {
            include "./app/Views/parts/header.php";
        }

        // Load nội dung chính
        include "./app/Views/$view.php";

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }
    
    private function loadCartCount() {
    if (!isset($_SESSION['email_khachhang'])) return 0;

    $email = $_SESSION['email_khachhang'];
    $cartModel = new Cart();

    $result = $cartModel->getOne("
        SELECT SUM(soluong) AS total
        FROM giohang
        WHERE email = '{$email}'
    ");

    return $result['total'] ?? 0;
}

    public function oldValue($old, $field)
    {
        return isset($old[$field]) ? htmlspecialchars($old[$field]) : '';
    }

    public function formError($errors, $field)
    {
        if(isset($errors[$field])) {
            // Nếu lỗi dạng nhiều loại (required, min, max,...)
            if(is_array($errors[$field])) {
                $msg = reset($errors[$field]);
            } else {
                $msg = $errors[$field];
            }

            return '<div class="text-danger" style="font-size:14px;">' . $msg . '</div>';
        }
        return '';
    }
    
    public function getFlash($key)
    {
        if(isset($_SESSION['flash'][$key])) {
            $value = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $value;
        }
        return null;
    }

    public function setSessionFlash($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
    }
}