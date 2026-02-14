<?php
class KhachHang extends CoreModel
{
    public function __construct()
    {
        parent::__construct();//Gọi lại hàm khởi tạo của lớp cha CoreModel
    }
    public function getAllKhachHangs(){
        return $this->getAll("SELECT * FROM khachhang"); //Gọi hàm getAll từ lớp cha CoreModel
    }

    public function insertKhachHangs($data)
    {
        return $this->insert('khachhang',$data);
    }

   public function updateKhachHang($data,$condition)
        {
            return $this->update('khachhang',$data,$condition);
        }

    public function deleteKhachHang($condition)
        {
            return $this->delete('khachhang',$condition);
        }
     public function getDetail($id) {
            $sql = "SELECT * FROM khachhang WHERE email = '$id'";
            return $this->getOne($sql);
        }
}