<?php
class Admins extends CoreModel
{
    public function __construct()
    {
        parent::__construct();//Gọi lại hàm khởi tạo của lớp cha CoreModel
    }
    public function getAllAdmins(){
        return $this->getAll("SELECT * FROM admins"); //Gọi hàm getAll từ lớp cha CoreModel
    }

    public function insertAdmins($data)
    {
        return $this->insert('admins',$data);
    }
     public function getDetail($id) {
            $sql = "SELECT * FROM admin WHERE email = '$id'";
            return $this->getOne($sql);
        }
     public function updateAdmin($data,$condition)
        {
            return $this->update('admin',$data,$condition);
        }
}