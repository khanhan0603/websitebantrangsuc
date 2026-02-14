<?php
class SanPhamADController extends BaseController
{
    protected $sanphamModel;
    protected $coreModel;

    public function __construct() {
        // Khởi tạo model dùng chung cho cả controller
        $this->sanphamModel = new Product();
        $this->coreModel = new CoreModel();
    }

    // Trang danh sách sản phẩm
    public function index() {
        $sanphams = $this->sanphamModel->getAllProducts();
        return $this->renderView("admin/sanphamcuatoi", [
            "sanphams" => $sanphams
        ]);
    }

    // Hiển thị form thêm sản phẩm
    public function showAdd() {
        $loaiModel = new LoaiSanPham();
        $loaisp = $loaiModel->getAllLoai();

        return $this->renderView('layouts-part/admin/add', [
            "loaisanpham" => $loaisp,
            'old' => []
        ]);
    }
    public function sanphamcuatoi() {
        $sanphams = $this->sanphamModel->getAllProducts(); // hoặc filter theo user

    return $this->renderView('layouts-part/admin/sanphamcuatoi', [
        'sanphams' => $sanphams
    ]);
    }
    // Xử lý thêm sản phẩm
    public function add() {
        if (!isPost()) return $this->showAdd();

        $filter = filterData();

        $errors = [];
        if (!$filter['masanpham'])  $errors['masanpham']="Thiếu mã sản phẩm";
        if (!$filter['tensanpham']) $errors['tensanpham']="Thiếu tên";
        if (!$filter['dongia'])     $errors['dongia']="Thiếu giá";
        if (!$filter['soluong'])    $errors['soluong']="Thiếu SL";
        if (!$filter['mota'])       $errors['mota']="Thiếu mô tả";
        if (!$filter['loaisanpham'])$errors['loaisanpham']="Thiếu loại";
        if (empty($_FILES['hinhanh']['name'])) $errors['hinhanh']="Chưa chọn hình";

        if ($errors) {
            setSessionFlash('errors',$errors);
            setSessionFlash('old',$filter);
            return reload('layouts-part/admin/add');
        }

        $image = $this->convertToJpeg($_FILES["hinhanh"]["tmp_name"]);

        $data = [
            'masanpham'     => $filter['masanpham'],
            'tensanpham'    => $filter['tensanpham'],
            'dongia'        => $filter['dongia'],
            'soluong'       => $filter['soluong'],
            'mota'          => $filter['mota'],
            'hinhanh'       => $image,
            'loai_hinhanh'   => 'image/jpeg',
            'loaisanpham'   => $filter['loaisanpham']
        ];

        $this->sanphamModel->insertProduct($data);

        setSessionFlash('msg','Thêm thành công');
        return reload('/sanphamcuatoi');
    }

    // Hiển thị form edit sản phẩm
    public function showEdit() {
        $masp = $_GET['masanpham'] ?? null;
        if (!$masp) die("Thiếu mã sản phẩm");

        $oldData = $this->sanphamModel->getOneSanPham($masp);
        if (!$oldData) die("Không tìm thấy sản phẩm");

        $loaiModel = new LoaiSanPham();
        $loaisp = $loaiModel->getAllLoai();

        return $this->renderView("layouts-part/admin/update", [
            "oldData" => $oldData,
            "loaisanpham" => $loaisp
        ]);
    }

    // Xử lý update sản phẩm
    public function edit() {
        if (!isPost()) return $this->showEdit();

        $filter = filterData();
        $masp = $filter['masanpham'];

        $errors = [];
        if (!$filter['tensanpham']) $errors['tensanpham']="Thiếu tên";
        if (!$filter['dongia'])     $errors['dongia']="Thiếu giá";
        if (!$filter['soluong'])    $errors['soluong']="Thiếu SL";
        if (!$filter['mota'])       $errors['mota']="Thiếu mô tả";
        if (!$filter['loaisanpham'])$errors['loaisanpham']="Thiếu loại";

        if ($errors) {
            setSessionFlash('errors',$errors);
            return reload("/admin/update?masanpham=$masp");
        }

        $old = $this->sanphamModel->getOneSanPham($masp);
        if (!$old) {
            setSessionFlash('msg','Sản phẩm không tồn tại');
            return reload('/sanphamcuatoi');
        }

        // Xử lý ảnh
        if (!empty($_FILES['hinhanh']['name'])) {
            $image = $this->convertToJpeg($_FILES["hinhanh"]["tmp_name"]);
            $mime  = "image/jpeg";
        } else {
            $image = $old['hinhanh'];
            $mime  = $old['loai_hinhanh'];
        }

        $data = [
            'tensanpham'  => $filter['tensanpham'],
            'dongia'      => $filter['dongia'],
            'soluong'     => $filter['soluong'],
            'mota'        => $filter['mota'],
            'hinhanh'     => $image,
            'loai_hinhanh' => $mime,
            'loaisanpham' => $filter['loaisanpham']
        ];

        $this->sanphamModel->updateProduct($masp, $data);

        setSessionFlash('msg','Cập nhật thành công!');
        return reload("/sanphamcuatoi");
    }

    // Xử lý xóa sản phẩm

public function delete() {
    // Lấy mã sản phẩm từ GET
    $masanpham = $_GET['masanpham'] ?? null;

    if (!$masanpham) {
        setSessionFlash('msg', 'Thiếu mã sản phẩm');
        setSessionFlash('msg_type','danger');
        return reload('/sanphamcuatoi');
    }

    // kiểm tra tồn tại sản phẩm
    $check = $this->sanphamModel->getOneSanPham($masanpham);
    if (!$check) {
        setSessionFlash('msg','Sản phẩm không tồn tại');
        setSessionFlash('msg_type','danger');
        return reload('/sanphamcuatoi');
    }

    // Thực hiện xóa
    if ($this->sanphamModel->deleteProduct($masanpham)) {
        setSessionFlash('msg','Xóa sản phẩm thành công');
        setSessionFlash('msg_type','success');
    } else {
        setSessionFlash('msg','Xóa sản phẩm thất bại');
        setSessionFlash('msg_type','danger');
    }

    return reload('/sanphamcuatoi');
}

    // Chuyển đổi ảnh sang JPEG
    private function convertToJpeg($tmpPath) {
        $imageResource = @imagecreatefromstring(file_get_contents($tmpPath));
        if (!$imageResource) die("Ảnh không hợp lệ");
        ob_start();
        imagejpeg($imageResource, null, 90);
        $jpegData = ob_get_clean();
        imagedestroy($imageResource);
        return $jpegData;
    }
}
