<?php
    class ChiTietDonHang extends CoreModel
    {
        public function __construct()
        {
            parent::__construct();//Gọi lại hàm khởi tạo của lớp cha CoreModel
        }

        public function insertChiTiet($mahoadon, $masanpham, $soluong, $dongia)
        {
            $thanhtien = $soluong * $dongia;

            $data = [
                'madonhang'  => $mahoadon,
                'masanpham' => $masanpham,
                'soluong'   => $soluong,
                'dongia'    => $dongia,
                'thanhtien' => $thanhtien
            ];

            return $this->insert("chi_tiet_don_hang", $data);
        }
        public function getChiTietByMaDonHang($mahoadon)
        {
            $sql = "SELECT ct.madonhang, sp.tensanpham, ct.soluong, ct.dongia, ct.thanhtien
                    FROM chi_tiet_don_hang ct
                    JOIN sanphams sp ON ct.masanpham = sp.masanpham
                    WHERE ct.madonhang = '$mahoadon'";

            return $this->getAll($sql, ['madonhang' => $mahoadon]);
        }
    }