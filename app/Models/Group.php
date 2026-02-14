<?php
class Group extends CoreModel
{
    public function __construct()
    {
        parent::__construct();//Gọi lại hàm khởi tạo của lớp cha CoreModel
    }
    public function getAllGroup(){
        //return $this->getAll("SELECT * FROM admins"); //Gọi hàm getAll từ lớp cha CoreModel
    }

    public function insertAdmins($data)
    {
        return $this->insert('admins',$data);
    }
}