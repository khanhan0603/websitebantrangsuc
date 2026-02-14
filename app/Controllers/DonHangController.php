<?php
class DonHangController extends BaseController
{
    private $DonHangModel;
    private $khachhangModel;
    private $cartModel;
    private $ChiTietDonHangModel;
    public function __construct()
    {
        $this->DonHangModel = new DonHang();
        $this->khachhangModel = new KhachHang();
        $this->cartModel=new Cart();
        $this->ChiTietDonHangModel = new ChiTietDonHang();
    }

    public function showCheckout()
    {
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
            //Lấy thông tin khách hàng
            $khachhangModel=$this->khachhangModel->getDetail($email);

                // Lấy dữ liệu giỏ hàng từ DB
            $cart = $this->cartModel->getAll("
                SELECT g.soluong, g.masanpham,s.tensanpham, s.hinhanh, s.loai_hinhanh, s.dongia
                FROM giohang g JOIN sanphams s ON g.masanpham = s.masanpham
                WHERE g.email = '$email'
            ");

            // Tính tổng số lượng
            $count = 0;
            //Tính tổng giá 
            $total=0;
            foreach ($cart as $item) {
                $count += $item['soluong'];
                $total += $item['dongia'] * $item['soluong'];
            }

            $data = [
                'khachhang' => $khachhangModel,
                'cart'  => $cart,
                'count' => $count,
                'total'=>$total
            ];
             $this->renderView("layouts-part/donhang",$data);
    }

    public function processCheckout()
    {
        if (!isset($_SESSION['email_khachhang'])) {
            die("Bạn phải đăng nhập để đặt hàng!");
        }

        $email  = $_SESSION['email_khachhang'];
        $hoten  = $_POST['hoten'];
        $sdt    = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $pttt   = $_POST['radio_thanhtoan'] ?? "0";

        if($pttt != "1") {
            die("Phương thức thanh toán không hợp lệ!");
        }
        else{
            $pttt = "Thanh toán khi nhận hàng";
        }
        // Lấy giỏ hàng
        $cart = $this->cartModel->getAll("
            SELECT g.masanpham, g.soluong, s.dongia, s.tensanpham
            FROM giohang g 
            JOIN sanphams s ON g.masanpham = s.masanpham
            WHERE g.email = '$email'
        ");

        if (empty($cart)) {
            die("Giỏ hàng trống, không thể đặt hàng!");
        }

        // Tính tổng số lượng & tổng tiền
        $tongsoluong = 0;
        $tongtien    = 0;

        foreach ($cart as $item) {
            $tongsoluong += $item['soluong'];
            $tongtien    += $item['soluong'] * $item['dongia'];
        }

        // 1️⃣ TẠO HÓA ĐƠN — lấy mahoadon
        $mahoadon = $this->DonHangModel->insertDonHang(
            $email,
            $tongsoluong,
            $tongtien
        );

        // 2️⃣ INSERT CHI TIẾT HÓA ĐƠN
        foreach ($cart as $item) {
            $tensanpham = $item['tensanpham'];
            $this->ChiTietDonHangModel->insertChiTiet(
                $mahoadon,
                $item['masanpham'],
                $item['soluong'],
                $item['dongia']
            );
        }

        // 3️⃣ XÓA GIỎ HÀNG
        //$this->cartModel->delete("giohang", "email = '$email'");

            // 4️⃣ LƯU THÔNG TIN ĐẶT HÀNG VÀO SESSION ĐỂ HIỂN THỊ POPUP
        $_SESSION['order_info'] = [
            'email'   => $email,
            'hoten'   => $hoten,
            'sdt'     => $sdt,
            'diachi'  => $diachi,
            'madonhang'=> $mahoadon,
            'tongtien'=> $tongtien,
            'pttt'    => $pttt
        ];

        // 5️⃣ Redirect
        header("Location: /BanTrangSuc/order_confirmation?madonhang=$mahoadon");
        exit;
    }
    public function orderConfirmation()
    {

        $order = $_SESSION['order_info'] ?? null;
        $chitiet = [];

        // Nếu session chưa có đầy đủ dữ liệu => lấy lại từ DB
        if (!$order || !isset($order['hoten'])) {

            $mahd = $_GET['madonhang'] ?? null;

            if (!$mahd) {
                header("Location: /BanTrangSuc/home");
                exit;
            }

            // Lấy hóa đơn + khách hàng
            $donhang = $this->DonHangModel->getDetail($mahd);  

            if (!$donhang) {
                die("Không tìm thấy hóa đơn!");
            }

            // Lấy chi tiết hàng
            $chitiet = $this->ChiTietDonHangModel->getChiTietByMaDonHang($mahd);

            // Tạo dữ liệu đầy đủ
            $order = [
                "madonhang" => $donhang['madonhang'],
                "email"    => $donhang['email'],
                "hoten"    => $donhang['hoten'],
                "sdt"      => $donhang['sdt'],
                "diachi"   => $donhang['diachi'],
                "tongtien" => $donhang['tongtien'],
                "pttt"     => $donhang['pttt']
            ];

            // Lưu lại session
            $_SESSION['order_info'] = $order;
        } 
        else {
            // Có session thì lấy chitiet ra
            $mahd = $order['madonhang'];
            $chitiet = $this->ChiTietDonHangModel->getChiTietByMaDonHang($mahd);
        }

        // Render view
        $this->renderView("layouts-part/order_confirmation", [
            "order" => $order,
            "chitiet" => $chitiet
        ]);
       
    }
    public function clearOrder()
{
    session_start();
    unset($_SESSION['order_info']); // Xóa session đặt hàng
    header("Location: /BanTrangSuc/home");
    exit;
}

   
}