<?php
    class KhachHangController extends BaseController
    {
         private $khachhangModel;

        public function __construct()
        {
            $this->khachhangModel = new KhachHang();
        }
        
        public function showProfileUser(){
             $email = $_GET['email'] ?? null;
            if (!$email) {
            //hiển thị thông báo phải đăng nhập và chuyển qua trang đăng nhập
            echo "
            <script>
                alert('Bạn phải đăng nhập để xem thông tin khách hàng!');
                window.location.href = '/BanTrangSuc/login_khachhang';
            </script>
            ";
            exit;
            
            }
            $khachhangModel=$this->khachhangModel->getDetail($email);
             $this->renderView("layouts-part/thongtin_khachhang", [
                'khachhang' => $khachhangModel
            ]);
        }

        public function updateProfileUser(){
            if(isPost()){
                $data = filterData();
                $condition = "email = '" . $data['email'] . "'";
                $result = $this->khachhangModel->updateKhachHang($data, $condition);
                if($result){
                    // Cập nhật thành công, có thể chuyển hướng hoặc hiển thị thông báo
                    header("Location: /BanTrangSuc/showProfileUser?email=" . $data['email']);
                    exit();
                } else {
                    // Xử lý lỗi cập nhật
                    echo "Cập nhật thất bại.";
                }
            }
        }
    }

?>