<?php

class LoaiSPController extends BaseController
{
    protected $loaisanphamModel;
    protected $coreModel;

    public function __construct()
    {
        $this->loaisanphamModel = new LoaiSanPham();
        $this->coreModel = new CoreModel();
    }

    public function loaisanpham()
    {
        $loais = $this->loaisanphamModel->getAllLoai();

        $this->renderView('layouts-part/admin/loaisanpham', [
            'loaisanpham' => $loais
        ]);
    }

    public function showAddLSP()
    {
       return $this->renderView('layouts-part/admin/addLSP', [
    'old' => []
]);

    }

   public function addLSP()
{
    if (!isPost()) return $this->showAddLSP();

    $filter = filterData();

    $errors = [];
    if (!$filter['maloai'])  $errors['maloai'] = "Thiếu mã loại";
    if (!$filter['tenloai']) $errors['tenloai'] = "Thiếu tên loại";

    if ($errors) {
        setSessionFlash('errors', $errors);
        setSessionFlash('old', $filter);
        return reload('/addLSP');  
    }

    $data = [
        'maloai'  => $filter['maloai'],
        'tenloai' => $filter['tenloai'],
    ];

    $this->loaisanphamModel->insertLoai($data);

    // Thiết lập session flash thành công
    setSessionFlash('success', 'Thêm loại sản phẩm thành công!');

    // Quay về trang danh sách loại sản phẩm
    return reload('/loaisanpham');
}


   public function showEditLSP()
{
    $maloai = $_GET['maloai'] ?? null;

    if (!$maloai) {
        echo "Không tìm thấy mã loại!";
        return;
    }

    $loai = $this->loaisanphamModel->getOneLoai($maloai);

    if (!$loai) {
        echo "Không tồn tại loại sản phẩm!";
        return;
    }

    // LẤY SESSION OLD KHI CÓ LỖI
    $old = $_SESSION['old'] ?? null;
    unset($_SESSION['old']);

    $this->renderView('layouts-part/admin/updateloai', [
        'loaisanpham' => $loai,
        'old' => $old ?? [],        // tránh lỗi undefined
        'oldData' => $old ?? []     // nếu view dùng oldData
    ]);
}

    public function editLSP()
    {
        if (!isPost()) return $this->showEditLSP();

        $data = filterData();
        $maloai = $data['maloai'] ?? null;

        if (!$maloai) {
            echo "Không tìm thấy mã loại!";
            return;
        }

        $updateData = [
            'tenloai' => $data['tenloai']
        ];

        $this->loaisanphamModel->updateLoai($maloai, $updateData);

        setSessionFlash('success', 'Cập nhật loại sản phẩm thành công!');
        reload('/loaisanpham');
    }

    public function deleteloai()
    {
        $maloai = $_GET['maloai'] ?? null;
        
        if (!$maloai) {
            echo "Không tìm thấy mã loại!";
            return;
        }

        $result = $this->loaisanphamModel->deleteLoai($maloai);

        setSessionFlash(
            $result['success'] ? 'success' : 'error',
            $result['message']
        );

        reload('/loaisanpham');
    }
}
