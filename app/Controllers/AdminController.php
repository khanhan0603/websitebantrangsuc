<?php

class AdminController extends BaseController
{
    private $adminModel;

        public function __construct()
        {
            $this->adminModel = new Admins();
        }
    public function dashboard()
    {
        $this->renderView('layouts-part/admin/shopcuatoi_admin');
    }

    public function tatcadonhang_admin()
    {
        $this->renderView('layouts-part/admin/tatcadonhang_admin');
    }

    public function thongTinAdmin()
    {
        // Debug xem có session không
        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";
        // die();

        // Kiểm tra đăng nhập đúng cách
        if (!getSession('admin_email')) {
            echo "
            <script>
                alert('Bạn phải đăng nhập để xem thông tin!');
                window.location.href = '/BanTrangSuc/login';
            </script>";
            exit;
        }

        // Lấy email từ session (đã được lưu khi đăng nhập)
        $email = getSession('admin_email');

        $admin = $this->adminModel->getDetail($email);
        // echo "<pre>";
        // print_r($admin);
        // echo "</pre>";
        // die();

        if (!$admin) {
            echo "<script>alert('Không tìm thấy thông tin admin!'); history.back();</script>";
            exit;
        }

        $this->renderView("layouts-part/admin/thongtin_admin", [
            'admin' => $admin
        ]);
    }
     public function updateAdmin(){
            if(isPost()){
                $data = filterData();
                $condition = "email = '" . $data['email'] . "'";
                $result = $this->adminModel->updateAdmin($data, $condition);
                if($result){
                    // Cập nhật thành công, có thể chuyển hướng hoặc hiển thị thông báo
                    header("Location: /BanTrangSuc/thongtinadmin");
                    exit();
                } else {
                    // Xử lý lỗi cập nhật
                    echo "Cập nhật thất bại.";
                }
            }
        }

}