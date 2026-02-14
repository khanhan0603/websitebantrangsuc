<?php
class LoaiSanPham extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
    }

    // Lấy tất cả loại sản phẩm
    public function getAllLoai()
    {
        return $this->getAll("SELECT * FROM loaisanpham");
    }

    // Lấy 1 loại sản phẩm theo mã
    public function getOneLoai($maloai)
    {
        $sql = "SELECT * FROM loaisanpham WHERE maloai = ?";
        return $this->getOne($sql, [$maloai]);
    }

    // Thêm loại sản phẩm
    public function insertLoai($data)
    {
        return $this->insert("loaisanpham", $data);
    }


    public function updateLoai($maloai, $data)
    {
        return $this->update("loaisanpham", $data, ['maloai' => $maloai]);
    }

    public function hasSanPham($maloai)
    {
        $sql = "SELECT COUNT(*) as total FROM sanphams WHERE loaisanpham = ?";
        $result = $this->getOne($sql, [$maloai]);
        return $result['total'] > 0;
    }

    public function deleteLoai($maloai)
    {
       
        if ($this->hasSanPham($maloai)) {
            return [
                "success" => false,
                "message" => "Không thể xóa. Mã loại này đang được sử dụng trong sản phẩm!"
            ];
        }
        $this->delete("loaisanpham", ['maloai' => $maloai]);
        return [
            "success" => true,
            "message" => "Xóa loại sản phẩm thành công!"
        ];
    }
}
