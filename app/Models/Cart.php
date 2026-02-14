<?php 
class Cart extends CoreModel
{
    public function __construct()
    {
        parent::__construct();//Gọi lại hàm khởi tạo của lớp cha CoreModel
    }
     public function getAllGioHang(){
        return $this->getAll("SELECT * FROM giohang"); //Gọi hàm getAll từ lớp cha CoreModel
    }

    public function insertGioHang($data)
    {
        return $this->insert('giohang',$data);
    }
     public function updateCart($data,$condition)
    {
            return $this->update('giohang',$data,$condition);
    } 
    public function deleteProduct($condition)
    {
            return $this->delete('giohang',$condition);
    }
}