<?php
 class CartController extends BaseController{
    private $productModel;
    private $cartModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->cartModel=new Cart();
    }

    public function showCart(){
         // Lấy email khách hàng
        $email = $_SESSION['email_khachhang'] ?? null;

        if (!$email) {
            //hiển thị thông báo phải đăng nhập và chuyển qua trang đăng nhập
            echo "
            <script>
                alert('Bạn phải đăng nhập để xem giỏ hàng!');
                window.location.href = '/BanTrangSuc/login_khachhang';
            </script>
            ";
            exit;
            
        }
        
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
            'cart'  => $cart,
            'count' => $count,
            'total'=>$total
        ];

        $this->renderView('layouts-part/cart', $data);
    }

    public function addToCart()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // check đăng nhập khách hàng
        if (!isset($_SESSION['email_khachhang'])) {
            die("Bạn phải đăng nhập để thêm sản phẩm vào giỏ!");
        }

        $email      = $_SESSION['email_khachhang'];
        $masanpham  = $_POST['masanpham'] ?? null;
        $soluong    = $_POST['soluong'] ?? 1;

        if (!$masanpham) die("Không có mã sản phẩm!");

        // Lấy thông tin sản phẩm
        $product = $this->productModel->getOne("
            SELECT * FROM sanphams WHERE masanpham = '$masanpham'
        ");

        if (!$product) die("Sản phẩm không tồn tại!");

        $dongia = $product['dongia'];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ chưa
        $cartItem = $this->cartModel->getOne("
            SELECT * FROM giohang 
            WHERE email = '$email' AND masanpham = '$masanpham'
        ");

        if ($cartItem) {
            // Cập nhật số lượng
            $newQty = $cartItem['soluong'] + $soluong;

            // Update
            $condition = ["email" => $email, "masanpham" => $masanpham];

            $this->cartModel->updateUser(
                "giohang",
                ['soluong' => $newQty],
                $condition
            );

        } else {
            // Thêm mới
            $this->cartModel->insert("giohang", [
                'email'      => $email,
                'masanpham'  => $masanpham,
                'soluong'    => $soluong,
                'thanhtien'  => $dongia
            ]);
        }

        // Redirect lại trang chi tiết
        header("Location: /BanTrangSuc/product_detail?masanpham=".$masanpham);
        exit;
    }
    public function removeCart(){
         if (session_status() === PHP_SESSION_NONE) session_start();

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['email_khachhang'])) {
            die("Bạn phải đăng nhập để xóa sản phẩm!");
        }

        $email     = $_SESSION['email_khachhang'];
        $masanpham = $_GET['masanpham'] ?? null;

        if (!$masanpham) {
            die("Không tìm thấy mã sản phẩm!");
        }

        // Điều kiện WHERE
        $condition = "email = '$email' AND masanpham = '$masanpham'";

        // Xóa dòng trong giỏ hàng
        $this->cartModel->deleteUser(
    'giohang',
    [
        'email'      => $email,
        'masanpham'  => $masanpham
    ]
);

        // Chuyển về trang giỏ hàng sau khi xóa
        header("Location: /BanTrangSuc/cart");
        exit;
    }
}